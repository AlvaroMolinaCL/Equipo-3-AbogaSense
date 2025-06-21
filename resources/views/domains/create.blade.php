@extends('layouts.app')

@section('title', 'Nuevo Dominio Personalizado - ' . config('app.name', 'Laravel'))

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="fw-bold mb-0 domains-create-title">
                <i class="bi bi-globe-americas me-2"></i>{{ __('Nuevo Dominio') }}
            </h3>
            <a href="{{ route('domains.index') }}" class="btn btn-sm domains-create-back-btn">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Formulario --}}
        <div class="card shadow border-0 domains-create-card">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('domains.store') }}" class="bg-white p-4 rounded-3 shadow-sm">
                    @csrf

                    <h5 class="fw-medium mb-3 domains-create-info-title">
                        <i class="bi bi-info-circle me-2"></i>Información del Dominio
                    </h5>

                    {{-- Dominio --}}
                    <div class="mb-4">
                        <label for="domain_name" class="form-label fw-medium domains-create-label">
                            <i class="bi bi-globe me-1"></i>Dominio
                        </label>
                        <div class="input-group">
                            <span class="input-group-text domains-create-input-group-text">
                                <i class="bi bi-fonts"></i>
                            </span>
                            <input id="domain_name" type="text" class="form-control border-start-0 domains-create-input"
                                placeholder="Por ejemplo: midominio.cl" name="domain_name" value="{{ old('domain_name') }}" required autofocus>
                        </div>
                        @error('domain_name')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tenant --}}
                    <div class="mb-4">
                        <label for="tenant" class="form-label fw-medium domains-create-label">
                            <i class="bi bi-fonts me-1"></i>Tenant
                        </label>
                        <div class="input-group">
                            <span class="input-group-text domains-create-input-group-text">
                                <i class="bi bi-type"></i>
                            </span>
                            <select id="tenant" class="form-select border-start-0" style="background-color: #FDF5E5;"
                                name="tenant">
                                <option disabled>Seleccione un tenant</option>
                                @foreach ($tenants as $tenant)
                                    <option value="{{ $tenant->id }}" {{ old('tenant_id') == '' }}>{{ $tenant->name }}
                                        ({{ $tenant->id . '.' . config('app.domain') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('tenant')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Botón Guardar --}}
                    <div class="mt-4 pt-3 border-top text-center">
                        <button type="submit" class="btn fw-medium py-1 domains-create-btn">
                            <i class="bi bi-save me-2"></i>Guardar Dominio
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
.domains-create-title {
    color: #8C2D18;
}
.domains-create-back-btn {
    background-color: #F5E8D0;
    color: #8C2D18;
}
.domains-create-card {
    background-color: #FDF5E5;
}
.domains-create-info-title {
    color: #8C2D18;
}
.domains-create-label {
    color: #8C2D18;
}
.domains-create-input-group-text {
    background-color: #F5E8D0;
    color: #8C2D18;
}
.domains-create-input {
    background-color: #FDF5E5;
}
.domains-create-btn {
    background-color: #8C2D18;
    color: white;
    width: 200px;
}
</style>
@endpush
