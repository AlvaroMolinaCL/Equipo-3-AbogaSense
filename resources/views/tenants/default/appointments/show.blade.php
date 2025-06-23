@extends('tenants.default.layouts.panel')

@section('title', 'Detalle de Cita - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
            <i class="bi bi-calendar-check me-2"></i>Detalle de Cita Agendada
        </h3>
        <a href="{{ route('appointments.index') }}" class="btn btn-sm"
            style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
              color: {{ tenantSetting('text_color_1', '#8C2D18') }};
              border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
            <i class="bi bi-arrow-left me-2"></i>Volver
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4" style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-person-circle me-2"></i>Información del Cliente
            </h5>
            <div class="row mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Nombre Completo:</label>
                    <div>{{ $appointment->first_name }} {{ $appointment->last_name }} {{ $appointment->second_last_name }}</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Correo Electrónico:</label>
                    <div>{{ $appointment->email }}</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Teléfono:</label>
                    <div>{{ $appointment->phone_number }}</div>
                </div>
            </div>

            <h5 class="fw-bold mb-3" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-clock me-2"></i>Información de la Cita
            </h5>
            <div class="row mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Fecha:</label>
                    <div>{{ \Carbon\Carbon::parse($appointment->availableSlot->date)->format('d/m/Y') }}</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Horario:</label>
                    <div>{{ substr($appointment->availableSlot->start_time, 0, 5) }} - {{ substr($appointment->availableSlot->end_time, 0, 5) }}</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Duración Estimada:</label>
                    <div>
                        {{ 
                            \Carbon\Carbon::parse($appointment->availableSlot->start_time)
                                ->diffInMinutes(\Carbon\Carbon::parse($appointment->availableSlot->end_time))
                        }} minutos
                    </div>
                </div>
            </div>

            @if($appointment->description)
                <h5 class="fw-bold mb-3" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-chat-left-text me-2"></i>Descripción
                </h5>
                <p class="text-muted">{{ $appointment->description }}</p>
            @endif
        </div>
    </div>
</div>
@endsection