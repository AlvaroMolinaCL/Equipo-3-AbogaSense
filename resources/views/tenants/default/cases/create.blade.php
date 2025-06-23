@extends('tenants.default.layouts.panel')

@section('title', 'Nuevo Caso - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-pencil-square me-2"></i>Nuevo Caso
            </h3>
            <a href="{{ route('cases.index') }}" class="btn btn-sm"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                   color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                   border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Formulario --}}
        <div class="card shadow border-0" style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('cases.store') }}">
                    @csrf

                    {{-- Título --}}
                    <div class="mb-4">
                        <label for="title" class="form-label fw-medium"
                            style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            <i class="bi bi-journal-text me-1"></i>Título del Caso
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                                     color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-fonts"></i>
                            </span>
                            <input id="title" type="text" name="title" class="form-control border-start-0"
                                style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};"
                                value="{{ old('title') }}" required>
                        </div>
                        @error('title')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-4">
                        <label for="description" class="form-label fw-medium"
                            style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            <i class="bi bi-textarea-resize me-1"></i>Descripción
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                                     color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-card-text"></i>
                            </span>
                            <textarea id="description" name="description" class="form-control border-start-0" rows="4"
                                style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};" required>{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Estado --}}
                    <div class="mb-4">
                        <label for="status" class="form-label fw-medium"
                            style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            <i class="bi bi-clipboard-check me-1"></i>Estado del Caso
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                                     color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-list-task"></i>
                            </span>
                            <select name="status" id="status" class="form-select border-start-0"
                                style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
                                @foreach (['pendiente', 'en progreso', 'resuelto'] as $estado)
                                    <option value="{{ $estado }}" {{ old('status') === $estado ? 'selected' : '' }}>
                                        {{ ucfirst($estado) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('status')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Usuario asignado --}}
                    <div class="mb-4">
                        <label for="user_id" class="form-label fw-medium"
                            style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            <i class="bi bi-person-badge me-1"></i>Asignar a Usuario
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                                     color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <select name="user_id" id="user_id" class="form-select border-start-0"
                                style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
                                <option value="">Sin asignar</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('user_id')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Botón --}}
                    <div class="mt-4 pt-3 border-top text-center">
                        <button type="submit" class="btn fw-medium py-1"
                            style="background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
                               color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};
                               width: 200px;">
                            <i class="bi bi-save me-2"></i>Crear Caso
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
