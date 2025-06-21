@extends('tenants.default.layouts.app')

@section('title', 'Confirmar Cita - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
@section('navbar-class', 'navbar-light-mode')
@include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

@section('content')
<section class="py-5" style="margin-top: 80px;">
    <div class="container">
        <div class="mb-5">
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-calendar2-check-fill fs-3 me-2" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};"></i>
                <h1 class="mb-0 fw-bold" style="font-family: {{ tenantSetting('heading_font', '') }}; color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    Confirmar Cita
                </h1>
            </div>

            <div class="rounded px-4 py-3 border" style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }}; border-color: #e0e0e0;">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center mb-2 mb-md-0">
                        <i class="bi bi-calendar-event me-2 text-secondary"></i>
                        <span><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($slot->date)->format('d/m/Y') }}</span>
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <i class="bi bi-clock me-2 text-secondary"></i>
                        <span><strong>Hora:</strong> {{ substr($slot->start_time, 0, 5) }} - {{ substr($slot->end_time, 0, 5) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('tenant.agenda.store') }}" method="POST">
            @csrf
            <input type="hidden" name="available_slot_id" value="{{ $slot->id }}">
            <input type="hidden" name="questionnaire_response_id" value="{{ $questionnaireResponseId }}">

            {{-- 🧍 DATOS PERSONALES --}}
            <div class="mb-4">
                <h5 class="fw-bold mb-3" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-person-lines-fill me-1"></i> Datos Personales
                </h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label">Nombre:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="Ej: Alejandra Andrea" value="{{ old('first_name', $user->name) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">Apellido Paterno:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                placeholder="Ej: Pérez" value="{{ old('last_name', $user->last_name) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="second_last_name" class="form-label">Apellido Materno:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="second_last_name" name="second_last_name"
                                placeholder="Ej: Soto" value="{{ old('second_last_name', $user->second_last_name) }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- 📞 CONTACTO --}}
            <div class="mb-4">
                <h5 class="fw-bold mb-3" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-envelope-paper-fill me-1"></i> Información de Contacto
                </h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Correo Electrónico:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Ej: miemail@gmail.com" value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone_number" class="form-label">Teléfono:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                placeholder="Ej: 987654321" value="{{ old('phone_number', $user->phone_number) }}" required>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 🌍 UBICACIÓN --}}
            <div class="mb-4">
                <h5 class="fw-bold mb-3" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-geo-alt-fill me-1"></i> Ubicación
                </h5>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="residence_region_id" class="form-label">Región de Residencia:</label>
                        <select name="residence_region_id" id="residence_region_id" class="form-select" required>
                            <option value="">Selecciona una región</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}"
                                    {{ old('residence_region_id', $user->residence_region_id) == $region->id ? 'selected' : '' }}>
                                    {{ $region->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="residence_commune_id" class="form-label">Comuna de Residencia:</label>
                        <select name="residence_commune_id" id="residence_commune_id" class="form-select" required>
                            <option value="">Selecciona una comuna</option>
                            @foreach ($communes as $commune)
                                <option value="{{ $commune->id }}"
                                    data-region="{{ $commune->region_id }}"
                                    {{ (old('residence_commune_id') !== null 
                                            ? old('residence_commune_id') == $commune->id 
                                            : $user->residence_commune_id == $commune->id) ? 'selected' : '' }}>
                                    {{ $commune->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="incident_region_id" class="form-label">Región del incidente:</label>
                        <select name="incident_region_id" id="incident_region_id" class="form-select" required>
                            <option value="">Selecciona una región</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}"
                                    {{ old('incident_region_id') == $region->id ? 'selected' : '' }}>
                                    {{ $region->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="incident_commune_id" class="form-label">Comuna del incidente:</label>
                        <select name="incident_commune_id" id="incident_commune_id" class="form-select" required>
                            <option value="">Selecciona una comuna</option>
                            @foreach ($communes as $commune)
                                <option value="{{ $commune->id }}" data-region="{{ $commune->region_id }}"
                                    {{ old('incident_commune_id') == $commune->id ? 'selected' : '' }}>
                                    {{ $commune->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn fw-bold text-white px-4 py-2"
                    style="background-color: {{ tenantSetting('navbar_color_2', '#4A1D0B') }};">
                    <i class="bi bi-check-circle-fill me-2"></i> Confirmar
                </button>
            </div>
        </form>
    </div>
</section>

    <script>
     // Script para el filtrado de residencia
    document.addEventListener('DOMContentLoaded', function () {
        const regionSelect = document.getElementById('residence_region_id');
        const communeSelect = document.getElementById('residence_commune_id');

        function filterCommunes() {
            const selectedRegion = regionSelect.value;
            let foundSelected = false;

            Array.from(communeSelect.options).forEach(option => {
                if (option.value === '') {
                    option.style.display = 'block';
                    return;
                }

                const communeRegionId = option.getAttribute('data-region');
                if (communeRegionId === selectedRegion) {
                    option.style.display = 'block';
                    if (
                        option.value === communeSelect.value
                    ) {
                        foundSelected = true;
                    }
                } else {
                    option.style.display = 'none';
                }
            });

            if (!foundSelected) {
                communeSelect.value = '';
            }
        }

        regionSelect.addEventListener('change', filterCommunes);
        filterCommunes();
    });

    // Script adicional para el filtrado del incidente
    document.addEventListener('DOMContentLoaded', function () {
        const incidentRegionSelect = document.getElementById('incident_region_id');
        const incidentCommuneSelect = document.getElementById('incident_commune_id');

        function filterIncidentCommunes() {
            const selectedRegion = incidentRegionSelect.value;
            let foundSelected = false;

            Array.from(incidentCommuneSelect.options).forEach(option => {
                if (option.value === '') {
                    option.style.display = 'block';
                    return;
                }

                const communeRegionId = option.getAttribute('data-region');
                if (communeRegionId === selectedRegion) {
                    option.style.display = 'block';
                    if (
                        option.value === incidentCommuneSelect.value
                    ) {
                        foundSelected = true;
                    }
                } else {
                    option.style.display = 'none';
                }
            });

            if (!foundSelected) {
                incidentCommuneSelect.value = '';
            }
        }

        incidentRegionSelect.addEventListener('change', filterIncidentCommunes);
        filterIncidentCommunes();
    });
    </script>
@endsection
