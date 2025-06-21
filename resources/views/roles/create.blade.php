@extends('layouts.app')

@section('title', 'Nuevo Rol - ' . config('app.name', 'Laravel'))

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="fw-bold mb-0 roles-create-title">
                <i class="bi bi-person-add me-2"></i>{{ __('Nuevo Rol') }}
            </h3>
            <a href="{{ route('roles.index') }}" class="btn btn-sm roles-create-back-btn">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Formulario --}}
        <div class="card shadow border-0 roles-create-card">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('roles.store') }}" class="bg-white p-4 rounded-3 shadow-sm">
                    @csrf

                    <h5 class="fw-medium mb-3 roles-create-info-title">
                        <i class="bi bi-info-circle me-2"></i>Información del Rol
                    </h5>

                    {{-- Nombre --}}
                    <div class="mb-4">
                        <label for="rol_name" class="form-label fw-medium roles-create-label">
                            <i class="bi bi-globe me-1"></i>Nombre
                        </label>
                        <div class="input-group">
                            <span class="input-group-text roles-create-input-group-text">
                                <i class="bi bi-fonts"></i>
                            </span>
                            <input id="rol_name" type="text" class="form-control border-start-0 roles-create-input"
                                placeholder="Por ejemplo: Admin" name="rol_name" value="{{ old('rol_name') }}" required
                                autofocus>
                        </div>
                        @error('rol_name')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Permisos --}}
                    <div class="mb-4">
                        <label class="form-label fw-medium roles-create-label">
                            <i class="bi bi-shield-lock me-1"></i>Permisos del Rol
                        </label>
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="{{ $permission->name }}" id="perm-{{ $permission->id }}">
                                        <label class="form-check-label" for="perm-{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Botón Guardar --}}
                    <div class="mt-4 pt-3 border-top text-center">
                        <button type="submit" class="btn fw-medium py-1 roles-create-save-btn">
                            <i class="bi bi-save me-2"></i>Guardar Rol
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
.roles-create-title {
    color: #8C2D18;
}
.roles-create-back-btn {
    background-color: #F5E8D0;
    color: #8C2D18;
}
.roles-create-card {
    background-color: #FDF5E5;
}
.roles-create-info-title {
    color: #8C2D18;
}
.roles-create-label {
    color: #8C2D18;
}
.roles-create-input-group-text {
    background-color: #F5E8D0;
    color: #8C2D18;
}
.roles-create-input {
    background-color: #FDF5E5;
}
.roles-create-save-btn {
    background-color: #8C2D18;
    color: white;
    width: 200px;
}
</style>
@endpush
