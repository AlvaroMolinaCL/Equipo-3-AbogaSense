@extends('layouts.app')

@section('title', 'Editar Usuario - ' . config('app.name', 'Laravel'))

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="fw-bold mb-0 user-edit-title">
                <i class="bi bi-person-gear me-2"></i>{{ __('Editar Usuario') }}
            </h3>
            <a href="{{ route('users.index') }}" class="btn btn-sm user-edit-btn-back">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Formulario --}}
        <div class="card shadow border-0 user-edit-card">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('users.update', $user->id) }}" class="bg-white p-4 rounded-3 shadow-sm">
                    @csrf
                    @method('PUT')

                    <h5 class="fw-medium mb-3 user-edit-section-title">
                        <i class="bi bi-info-circle me-2"></i>Información del Usuario
                    </h5>

                    {{-- Nombre --}}
                    <div class="mb-4">
                        <label for="name" class="form-label fw-medium user-edit-label">
                            <i class="bi bi-person me-1"></i>Nombre Completo
                        </label>
                        <div class="input-group">
                            <span class="input-group-text user-edit-input-group-text">
                                <i class="bi bi-fonts"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 user-edit-input"
                                placeholder="Por ejemplo: Juan Pérez" id="name" name="name"
                                value="{{ old('name', $user->name) }}" required autofocus>
                        </div>
                        @error('name')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="form-label fw-medium user-edit-label">
                            <i class="bi bi-envelope me-1"></i>Correo Electrónico
                        </label>
                        <div class="input-group">
                            <span class="input-group-text user-edit-input-group-text">
                                <i class="bi bi-at"></i>
                            </span>
                            <input type="email" class="form-control border-start-0 user-edit-input"
                                placeholder="Por ejemplo: miemail@gmail.com" id="email" name="email"
                                value="{{ old('email', $user->email) }}" required>
                        </div>
                        @error('email')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Contraseña (Opcional) --}}
                    <div class="mb-4">
                        <label for="password" class="form-label fw-medium user-edit-label">
                            <i class="bi bi-lock me-1"></i>Contraseña (opcional)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text user-edit-input-group-text">
                                <i class="bi bi-key"></i>
                            </span>
                            <input type="password" class="form-control border-start-0 user-edit-input"
                                placeholder="Ingrese una contraseña segura" id="password" name="password">
                            <button class="btn" type="button" class="user-edit-input-group-text"
                                onclick="togglePassword('password')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Confirmar Contraseña --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-medium user-edit-label">
                            <i class="bi bi-lock me-1"></i>Confirmar Contraseña
                        </label>
                        <div class="input-group">
                            <span class="input-group-text user-edit-input-group-text">
                                <i class="bi bi-key-fill"></i>
                            </span>
                            <input type="password" class="form-control border-start-0 user-edit-input"
                                placeholder="Confirme la contraseña ingresada anteriormente" id="password_confirmation"
                                name="password_confirmation">
                            <button class="btn" type="button" class="user-edit-input-group-text"
                                onclick="togglePassword('password_confirmation')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Roles --}}
                    <div class="mb-4">
                        <label for="roles" class="form-label fw-medium user-edit-label">
                            <i class="bi bi-person-gear me-1"></i>Rol
                        </label>
                        <div class="input-group">
                            <span class="input-group-text user-edit-input-group-text">
                                <i class="bi bi-shield-check"></i>
                            </span>
                            <select name="roles[]" id="roles" class="form-select border-start-0 user-edit-input">
                                <option value="role_default" disabled>
                                    Seleccione un rol
                                </option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if (in_array($role->id, $user->roles->pluck('id')->toArray())) selected @endif>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('roles')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Botón de Guardar --}}
                    <div class="mt-4 pt-3 border-top text-center">
                        <button type="submit" class="btn fw-medium py-1 user-edit-btn-save">
                            <i class="bi bi-save me-2"></i>Actualizar Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
@endsection

@push('styles')
<style>
    .user-edit-title { color: #8C2D18; }
    .user-edit-btn-back { background-color: #F5E8D0; color: #8C2D18; }
    .user-edit-card { background-color: #FDF5E5; }
    .user-edit-section-title { color: #8C2D18; }
    .user-edit-label { color: #8C2D18; }
    .user-edit-input-group-text { background-color: #F5E8D0; color: #8C2D18; }
    .user-edit-input { background-color: #FDF5E5; }
    .user-edit-btn-save { background-color: #8C2D18; color: white; width: 200px; }
</style>
@endpush
