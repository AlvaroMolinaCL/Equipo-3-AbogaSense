@extends('tenants.default.layouts.panel')

@section('title', 'Panel de Control - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-speedometer2 me-2"></i>
                {{ __('Panel de Control') }}
            </h3>
        </div>

        {{-- Métricas --}}
        <div class="row mb-4 justify-content-center">
            {{-- Usuarios Registrados --}}
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card text-white h-100" style="background-color: {{ tenantSetting('color_metrics', '#BF8A49') }};">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="card-subtitle mb-2"
                                    style="color: {{ tenantSetting('navbar_text_color_1', '#8C2D18') }};">Usuarios
                                    Registrados</h6>
                                <h3 class="card-title"
                                    style="color: {{ tenantSetting('navbar_text_color_1', '#8C2D18') }};">
                                    {{ $user_count }}</h3>
                            </div>
                            <i class="bi bi-people fs-1 opacity-50"
                                style="color: {{ tenantSetting('navbar_text_color_1', '#8C2D18') }};"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Usuarios Nuevos Hoy --}}
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card text-white h-100"
                    style="background-color: {{ tenantSetting('color_metrics', '#BF8A49') }};">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="card-subtitle mb-2"
                                    style="color: {{ tenantSetting('navbar_text_color_1', '#8C2D18') }};">Nuevos Hoy</h6>
                                <h3 class="card-title"
                                    style="color: {{ tenantSetting('navbar_text_color_1', '#8C2D18') }};">
                                    {{ $user_today }}</h3>
                            </div>
                            <i class="bi bi-person-plus fs-1 opacity-50"
                                style="color: {{ tenantSetting('navbar_text_color_1', '#8C2D18') }};"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            {{-- Gráfico de Citas Agendadas --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center"
                        style="background-color: {{ tenantSetting('color_metrics', '#BF8A49') }}; color: white;">
                        <h5 class="mb-0">Citas agendadas en los últimos
                            <form method="GET" class="d-inline" style="width: 80px;">
                                <input type="number" min="1" max="60" name="appointments_days"
                                    value="{{ $appointments_days }}" class="form-control form-control-sm d-inline"
                                    style="width: 60px; display: inline-block;" onchange="this.form.submit()">
                            </form>
                            días
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="appointmentsChart" style="min-height:300px;"></canvas>
                    </div>
                </div>
            </div>

            {{-- Gráfico de Planes Más Reservados --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center"
                        style="background-color: {{ tenantSetting('color_metrics', '#BF8A49') }}; color: white;">
                        <h5 class="mb-0">Planes más reservados en los últimos
                            <form method="GET" class="d-inline" style="width: 80px;">
                                <input type="number" min="1" max="90" name="plans_days"
                                    value="{{ $plans_days }}" class="form-control form-control-sm d-inline"
                                    style="width: 60px; display: inline-block;" onchange="this.form.submit()">
                            </form>
                            días
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="plansChart" style="min-height:300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabla de Usuarios --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }}; color: white;">
                <h5 class="mb-0">Últimos Usuarios</h5>
                <a href="{{ route('users.index') }}" class="btn btn-sm"
                    style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-eye"></i> Ver Usuarios
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: {{ tenantSetting('button_banner_text_color', '#FDF5E5') }};">
                            <tr>
                                <th style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Nombre</th>
                                <th style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Email</th>
                                <th style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">Registro</th>
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
                                    <td colspan="4" class="text-center py-3 text-muted">No hay usuarios registrados en
                                        los últimos 5 días.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gráfico de Citas Agendadas
        const appointmentsCtx = document.getElementById('appointmentsChart').getContext('2d');
        new Chart(appointmentsCtx, {
            type: 'line',
            data: {
                labels: @json($appointmentsChart['labels']),
                datasets: [{
                    label: 'Citas',
                    data: @json($appointmentsChart['data']),
                    borderColor: '#8C2D18',
                    backgroundColor: 'rgba(140,45,24,0.1)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Días',
                            font: {
                                size: 10
                            }
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Cantidad de Citas Agendadas',
                            font: {
                                size: 10
                            }
                        },
                        ticks: {
                            stepSize: 1,
                        },
                    },
                },
            }
        });

        // Gráfico de Planes Más Reservados
        const plansCtx = document.getElementById('plansChart').getContext('2d');
        new Chart(plansCtx, {
            type: 'bar',
            data: {
                labels: @json($plansChart['labels']),
                datasets: [{
                    label: 'Reservas',
                    data: @json($plansChart['data']),
                    backgroundColor: '#BF8A49'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Planes',
                            font: {
                                size: 10
                            }
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Cantidad de Reservas',
                            font: {
                                size: 10
                            }
                        },
                        ticks: {
                            stepSize: 1,
                        },
                    },
                },
            }
        });
    });
</script>
