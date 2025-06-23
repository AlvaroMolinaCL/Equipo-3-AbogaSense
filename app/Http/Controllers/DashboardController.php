<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Product;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user_count = User::count();
        $user_today = User::whereDate('created_at', '=', now()->format('Y-m-d'))->count();
        $last_users = User::whereRaw('DATE(created_at) >= ?', now()->subDays(5)->format('Y-m-d'))->get();

        if (tenant()) {
            // Gráfico 1: Citas agendadas en los últimos X días
            $appointments_days = $request->input('appointments_days', 7);
            $appointments = Appointment::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->where('created_at', '>=', now()->subDays($appointments_days))
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            $appointmentsChart = [
                'labels' => $appointments->pluck('date')->map(fn($d) => Carbon::parse($d)->format('d/m'))->toArray(),
                'data' => $appointments->pluck('count')->toArray(),
            ];

            // Gráfico 2: Planes más reservados en los últimos X días
            $plans_days = $request->input('plans_days', 30);
            $plans = DB::table('order_items')
                ->select('product_id', DB::raw('COUNT(*) as count'))
                ->where('created_at', '>=', now()->subDays($plans_days))
                ->groupBy('product_id')
                ->orderByDesc('count')
                ->limit(10)
                ->get();

            $productNames = Product::whereIn('id', $plans->pluck('product_id'))->pluck('name', 'id');
            $plansChart = [
                'labels' => $plans->pluck('product_id')->map(fn($id) => $productNames[$id] ?? 'Producto ' . $id)->toArray(),
                'data' => $plans->pluck('count')->toArray(),
            ];
        }

        if (tenant()) {
            return view(tenantView('dashboard'), [
                'user_count' => $user_count,
                'user_today' => $user_today,
                'last_users' => $last_users,
                'appointmentsChart' => $appointmentsChart,
                'plansChart' => $plansChart,
                'appointments_days' => $appointments_days,
                'plans_days' => $plans_days,
            ]);
        } else {
            $tenant_count = Tenant::count();
            $tenant_today = Tenant::whereDate('created_at', '=', now()->format('Y-m-d'))->count();
            $last_tenants = Tenant::whereRaw('DATE(created_at) >= ?', now()->subDays(5)->format('Y-m-d'))->get();

            return view('dashboard', [
                'user_count' => $user_count,
                'user_today' => $user_today,
                'last_users' => $last_users,
                'tenant_count' => $tenant_count,
                'tenant_today' => $tenant_today,
                'last_tenants' => $last_tenants,
            ]);
        }
    }
}
