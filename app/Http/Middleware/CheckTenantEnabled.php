<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckTenantEnabled
{
    public function handle(Request $request, Closure $next)
    {
        $tenant = tenancy()->tenant;

        if ($tenant && !$tenant->enabled) {
            // Bloquear el subdominio mostrando un error o redirigiendo
            return response()->view('errors.tenant_disabled', [], 403);
        }

        return $next($request);
    }
}
