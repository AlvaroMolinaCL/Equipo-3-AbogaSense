<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TenantPurchase;
use App\Models\Order;
use Illuminate\Support\Str;

class PlanCheckoutController extends Controller
{
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
            'plan_price' => 'required|numeric',
        ]);

        // Crear una orden temporal
        $order = Order::create([
            'user_id' => auth()->id() ?? null,
            'amount' => $validated['plan_price'],
            'status' => 'pending',
            'order_code' => Str::uuid(),
        ]);

        // Guardar datos en sesión para después del pago
        session([
            'purchase_details' => [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'plan_name' => $validated['plan_name'],
                'plan_price' => $validated['plan_price'],
                'order_id' => $order->id,
            ],
            'current_order_id' => $order->id,
        ]);

        // Redirigir a Transbank con el monto
        return redirect()->route('transbank.create', ['amount' => $validated['plan_price']]);
    }

    public function handleSuccess(Request $request)
    {
        try {
            $purchaseDetails = session('purchase_details');

            if (!$purchaseDetails) {
                return redirect()->route('plan.checkout.form', ['plan' => 'basico'])
                    ->with('error', 'No se encontraron los detalles de la compra.');
            }

            // Crear registro en TenantPurchase
            TenantPurchase::create([
                'order_id' => $purchaseDetails['order_id'],
                'plan_name' => $purchaseDetails['plan_name'],
                'plan_price' => $purchaseDetails['plan_price'],
                'name' => $purchaseDetails['name'],
                'email' => $purchaseDetails['email'],
                'phone' => $purchaseDetails['phone'],
                'status' => 'completed',
                'tenant_slug' => Str::slug($purchaseDetails['name']),
                'activated_at' => now()
            ]);

            // Actualizar orden a completada
            Order::where('id', $purchaseDetails['order_id'])->update(['status' => 'completed']);

            // Limpiar sesión
            session()->forget(['purchase_details', 'current_order_id']);

            return view('tenants.default.webpay.success', [
                'buyOrder' => $purchaseDetails['order_id'],
                'amount' => $purchaseDetails['plan_price'],
                'transactionDate' => now()->format('Y-m-d H:i:s')
            ]);

        } catch (\Exception $e) {
            return redirect()->route('plan.checkout.form', ['plan' => 'basico'])
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function handleFailure()
    {
        $purchaseDetails = session('purchase_details');

        if (session('current_order_id')) {
            Order::where('id', session('current_order_id'))->delete();
        }

        session()->forget(['purchase_details', 'current_order_id']);

        return view('tenants.default.webpay.failure');
    }
}