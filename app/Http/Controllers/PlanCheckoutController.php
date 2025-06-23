<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\PlanConfirmationMail;
use App\Models\Tenant;
use Database\Seeders\Tenant\TenantInitialSetupSeeder;

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
                    'Gestión de clientes',
                    'Pasarela de pagos integrada',

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
                    'Chatbot inteligente',                ]
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
            'subdomain' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('tenants', 'id'),
                Rule::unique('domains', 'domain')
            ],
            'plan_name' => 'required|string',
            'plan_price' => 'required|numeric'
        ]);

        try {
            $order = Order::create([
                'amount' => $request->plan_price,
                'status' => 'pending',
                'plan_name' => $validated['plan_name'],
                'customer_name' => $validated['name'],
                'customer_email' => $validated['email'],
                'customer_phone' => $validated['phone'],
                'subdomain' => $validated['subdomain'],

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
                // Actualizar estado de la orden
                $order->update([
                    'status' => 'completed',
                    'transaction_code' => $response->getAuthorizationCode(),
                    'transaction_date' => $response->getTransactionDate()
                ]);

                // Crear el tenant automáticamente
                $tenantData = $this->createTenantFromOrder($order);
                $tenant = $tenantData['tenant'];
                $password = $tenantData['password'];

                // Enviar email de confirmación
                Mail::to($order->customer_email)->send(
                    new PlanConfirmationMail(
                        $order->customer_name,
                        $order->plan_name,
                        $order->amount,
                        $response->getAuthorizationCode(),
                        $response->getTransactionDate(),
                        $order->customer_email,
                        $password,
                        $tenant->id . '.' . config('app.domain')
                    )
                );


                return view('webpay.success', [
                    'buyOrder' => $order->id,
                    'amount' => $order->amount,
                    'authorizationCode' => $response->getAuthorizationCode(),
                    'transactionDate' => $response->getTransactionDate(),
                    'planName' => $order->plan_name,
                    'tenantUrl' => $tenant->id . '.' . config('app.domain')
                ]);
            }

            return view('webpay.failure', [
                'buyOrder' => $order->id,
                'responseCode' => $response->getResponseCode(),
                'errorMessage' => $this->getResponseMessage($response->getResponseCode())
            ]);

        } catch (\Exception $e) {
            Log::error('Error en handleResponse: ' . $e->getMessage());
            return view('webpay.failure')->with('error', $e->getMessage());
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

    protected function createTenantFromOrder(Order $order)
    {
        $subdomain = $order->subdomain;

        if ($order->tenant_id && Tenant::find($order->tenant_id)) {
            return [
                'tenant' => Tenant::find($order->tenant_id),
                'password' => null
            ];
        }


        $tenant = Tenant::create([
            'id' => $subdomain,
            'name' => $order->customer_name,
            'email' => $order->customer_email,
        ]);

        $tenant->domains()->create([
            'domain' => $subdomain . '.' . config('app.domain')
        ]);

        tenancy()->initialize($tenant);

        $password = Str::random(12);

        (new TenantInitialSetupSeeder(
            name: $order->customer_name,
            email: $order->customer_email,
            password: $password,
        ))->run();

        Log::info("Contraseña generada para tenant {$tenant->id}: {$password}");

        tenancy()->end();

        $order->tenant_id = $tenant->id;
        $order->save();

        return [
            'tenant' => $tenant,
            'password' => $password
        ];
    }


}