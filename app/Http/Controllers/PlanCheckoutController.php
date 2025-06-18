<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Str;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class PlanCheckoutController extends Controller
{
    public function __construct()
    {

        if (config('app.env') == 'production') {
            WebpayPlus::configureForProduction(
                config('services.transbank.commerce_code'),
                config('services.transbank.api_key')
            );
        } else {
            WebpayPlus::configureForTesting();
        }
    }

    public function showForm($plan)
    {
        $plans = [
            'basico' => [
                'name' => 'Básico',
                'price' => 79990,
                'features' => [
                    'Página web personalizada',
                    'Agendamiento de citas',
                    'Gestión de clientes'
                ]
            ],
            'profesional' => [
                'name' => 'Profesional',
                'price' => 169990,
                'features' => [
                    'Página web personalizada',
                    'Agendamiento de citas',
                    'Gestión de clientes',
                    'Pasarela de pagos integrada',
                    'Gestión de archivos'
                ]
            ],
            'premium' => [
                'name' => 'Premium',
                'price' => 239990,
                'features' => [
                    'Página web personalizada',
                    'Agendamiento de citas',
                    'Gestión de clientes',
                    'Pasarela de pagos integrada',
                    'Gestión de archivos',
                    'Chatbot inteligente',
                    'Soporte prioritario'
                ]
            ],
        ];

        if (!isset($plans[$plan])) {
            abort(404, 'El plan seleccionado no existe.');
        }

        return view('planCheckout', ['plan' => $plans[$plan]]);
    }

    public function processPayment(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'plan_name' => 'required|string',
            'plan_price' => 'required|numeric'
        ]);

        try {
            $order = Order::create([
                'amount' => $request->plan_price,
                'status' => 'pending',
                'type' => 'plan_purchase',
                'plan_name' => $validated['plan_name'],
                'customer_name' => $validated['name'],
                'customer_email' => $validated['email'],
                'customer_phone' => $validated['phone'],
            ]);

            $sessionId = uniqid();
            $returnUrl = url('/planes/respuesta'); // URL absoluta

            $response = (new Transaction)->create(
                $order->id, // buyOrder
                $sessionId,
                $validated['plan_price'],
                $returnUrl
            );

            return response()->json([
                'url' => $response->getUrl(),
                'token' => $response->getToken()
            ]);

        } catch (\Exception $e) {
            Log::error('Error procesando pago: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function handleResponse(Request $request)
    {
        $token = $request->input('token_ws') ?? $request->query('token_ws');

        if (!$token) {
            return view('webpay.cancelled');
        }

        try {
            $response = (new Transaction)->commit($token);
            $order = Order::findOrFail($response->getBuyOrder());

            if ($response->isApproved()) {
                // Actualiza el monto desde la respuesta de Webpay (no desde la orden)
                $amountFromWebpay = $response->getAmount(); // Importante

                $order->update([
                    'status' => 'completed',
                    'amount' => $amountFromWebpay, // Guarda el monto real
                    'transaction_code' => $response->getAuthorizationCode(),
                    'transaction_date' => $response->getTransactionDate()
                ]);

                return view('webpay.success', [
                    'buyOrder' => $order->id,
                    'amount' => $amountFromWebpay, // Usa el monto de Webpay
                    'authorizationCode' => $response->getAuthorizationCode(),
                    'transactionDate' => $response->getTransactionDate(),
                    'planName' => $order->plan_name
                ]);
            }


            // Pago rechazado: pasa los datos clave a la vista
            return view('webpay.failure', [
                'buyOrder' => $order ? $order->id : 'N/A', // Siempre pasa buyOrder
                'responseCode' => $response->getResponseCode(),
                'errorMessage' => $this->getResponseMessage($response->getResponseCode()),
                'isPlanPurchase' => true
            ]);


        } catch (\Exception $e) {
            Log::error("Error en handleResponse: " . $e->getMessage());
            return view('webpay.failure', [
                'error' => $e->getMessage(),
                'buyOrder' => 'N/A' // Asegura que la variable exista
            ]);
        }
    }

    protected function getResponseMessage($responseCode)
    {
        $messages = [
            -1 => 'Transacción rechazada',
            0 => 'Transacción aprobada',
            1 => 'Transacción rechazada por tarjeta inválida',
            2 => 'Transacción rechazada por fondos insuficientes',
            3 => 'Transacción rechazada por tarjeta vencida',
            4 => 'Transacción rechazada por tarjeta restringida',
            5 => 'Transacción rechazada por error en el proceso',
            6 => 'Transacción rechazada por intentos excedidos',
            7 => 'Transacción rechazada por tarjeta bloqueada',
            8 => 'Transacción rechazada por tarjeta reportada',
            97 => 'Límite excedido en monto de transacciones',
            98 => 'Límite excedido en frecuencia de transacciones',
            99 => 'Transacción rechazada por error general'
        ];

        return $messages[$responseCode] ?? 'Error desconocido en la transacción';
    }
}