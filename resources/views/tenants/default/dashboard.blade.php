@extends('tenants.default.layouts.panel')

@section('title', 'Panel de Control - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@push('styles')
<style>
.dashboard-title {
    color: {{ tenantSetting('text_color_1', '#8C2D18') }};
}
.dashboard-card-metrics {
    background-color: {{ tenantSetting('color_metrics', '#BF8A49') }};
    color: white;
}
.dashboard-card-metrics .card-subtitle,
.dashboard-card-metrics .card-title,
.dashboard-card-metrics .bi {
    color: {{ tenantSetting('navbar_text_color_1', '#8C2D18') }};
}
.dashboard-table-header {
    background-color: {{ tenantSetting('button_banner_text_color', '#FDF5E5') }};
}
.dashboard-table-header th {
    color: {{ tenantSetting('text_color_1', '#8C2D18') }};
}
.dashboard-users-header {
    background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
    color: white;
}
.dashboard-users-btn {
    background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};
    color: {{ tenantSetting('text_color_1', '#8C2D18') }};
}
</style>
@endpush

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0 dashboard-title">
                <i class="bi bi-speedometer2 me-2"></i>
                {{ __('Panel de Control') }}
            </h3>
        </div>

        {{-- Métricas --}}
        <div class="row mb-4 justify-content-center">
            {{-- Usuarios Registrados --}}
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card text-white h-100 dashboard-card-metrics">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="card-subtitle mb-2">Usuarios Registrados</h6>
                                <h3 class="card-title">{{ $user_count }}</h3>
                            </div>
                            <i class="bi bi-people fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Usuarios Nuevos Hoy --}}
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card text-white h-100 dashboard-card-metrics">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="card-subtitle mb-2">Nuevos Hoy</h6>
                                <h3 class="card-title">{{ $user_today }}</h3>
                            </div>
                            <i class="bi bi-person-plus fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabla de Usuarios --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center dashboard-users-header">
                <h5 class="mb-0">Últimos Usuarios</h5>
                <a href="{{ route('users.index') }}" class="btn btn-sm dashboard-users-btn">
                    <i class="bi bi-eye"></i> Ver Usuarios
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="dashboard-table-header">
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($last_users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">No hay usuarios registrados en los últimos 5 días.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
