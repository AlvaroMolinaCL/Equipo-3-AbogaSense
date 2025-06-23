@extends('tenants.default.layouts.app')

@section('title', tenantPageName('register', 'Registrarse') . ' - ' . tenantSetting('name', 'Tenant'))

@section('body-class', 'theme-light')

@section('content')
    <div class="container py-3 d-flex align-items-center justify-content-center" style="min-height: 100vh; margin-top: 40px;">
        <div class="col-md-8 col-10 col-lg-6">
            <div class="shadow-lg rounded-4 overflow-hidden"
                style="background-color: {{ tenantSetting('background_color_1', '#fdf5e5') }}; border-left: 10px solid {{ tenantSetting('navbar_color_1', '#6B3A2C') }};">

                {{-- Logo arriba del formulario --}}
                <div class="text-center py-3" style="background-color: {{ tenantSetting('background_color_1', '#fdf5e5') }};">
                    <img src="{{ asset(tenantSetting('logo_path_1', '/images/logo/Logo_1_(Predeterminado).png')) }}" alt="Logo del despacho"
                        style="height: 100px;" class="img-fluid">
                </div>

                <div class="p-3 bg-white">

                    {{-- Encabezado --}}
                    <div class="text-center mb-4">
                        <h3
                            style="color: {{ tenantSetting('navbar_color_1', '#4A1D0B') }}; ; font-family: {{ tenantSetting('heading_font', 'serif') }}">
                            <i class="bi bi-person-plus-fill me-2"></i> Crear Nueva Cuenta
                        </h3>
                        <p class="text-muted">Regístrate para crear una nueva cuenta</p>
                    </div>

                    @php
                        $hayUsuarios = \App\Models\User::count() > 0;
                    @endphp

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Nombre --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombres <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Por ejemplo: Alejandra Andrea" id="name" name="name"
                                value="{{ old('name') }}" required autofocus>
                        </div>

                        {{-- Apellido Paterno --}}
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Apellido Paterno <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                placeholder="Por ejemplo: Pereira" id="last_name" name="last_name"
                                value="{{ old('last_name') }}" required>
                        </div>

                        {{-- Apellido Materno --}}
                        <div class="mb-3">
                            <label for="second_last_name" class="form-label">Apellido Materno <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('second_last_name') is-invalid @enderror"
                                placeholder="Por ejemplo: Soto" id="second_last_name" name="second_last_name"
                                value="{{ old('second_last_name') }}" required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico <span
                                    class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Por ejemplo: miemail@gmail.com" id="email" name="email"
                                value="{{ old('email') }}" required>
                        </div>

                        {{-- Teléfono --}}
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Teléfono <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                placeholder="Por ejemplo: 912345678" id="phone_number" name="phone_number" required
                                value="{{ old('phone_number') }}">
                        </div>

                        {{-- Género --}}
                        <div class="mb-3">
                            <label for="genre_id" class="form-label">Género</label>
                            <select class="form-select @error('genre_id') is-invalid @enderror" id="genre_id"
                                name="genre_id">
                                <option value="">Seleccione...</option>
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}"
                                        {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Fecha de Nacimiento --}}
                        <div class="mb-3">
                            <label for="birth_date" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                        </div>

                        {{-- Región --}}
                        <div class="mb-3">
                            <label for="residence_region_id" class="form-label">Región de Residencia</label>
                            <select class="form-select @error('residence_region_id') is-invalid @enderror"
                                id="residence_region_id" name="residence_region_id">
                                <option value="">Seleccione una región</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}"
                                        {{ old('residence_region_id') == $region->id ? 'selected' : '' }}>
                                        {{ $region->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Comuna --}}
                        <div class="mb-3">
                            <label for="residence_commune_id" class="form-label">Comuna de Residencia</label>
                            <select class="form-select @error('residence_commune_id') is-invalid @enderror"
                                id="residence_commune_id" name="residence_commune_id">
                                <option value="">Seleccione una comuna</option>
                            </select>
                        </div>

                        {{-- Contraseña --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="Ingrese una contraseña segura" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirmar Contraseña --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control"
                                placeholder="Confirme la contraseña ingresada anteriormente" id="password_confirmation"
                                name="password_confirmation" required>
                        </div>

                        {{-- Botón --}}
                        <div class="d-grid">
                            <button type="submit" class="btn text-white"
                                style="background-color: {{ tenantSetting('navbar_color_1', '#4A1D0B') }};">
                                <i class="bi bi-check2-circle me-1"></i> Registrarse
                            </button>
                        </div>

                        {{-- Link a Nogin --}}
                        <div class="mt-4 text-center">
                            <p class="text-muted">¿Ya tienes una cuenta?
                                <a href="{{ route('login') }}" class="text-decoration-none"
                                    style="color: {{ tenantSetting('navbar_color_1', '#4A1D0B') }};">
                                    Iniciar sesión
                                </a>
                            </p>
                        </div>
                    </form>

                </div>
            </div>
            <div class="mt-3 text-center">
                <a href="/" class="text-decoration-none"
                    style="color: {{ tenantSetting('navbar_color_1', '#4A1D0B') }};">Volver a
                    {{ tenantSetting('name', 'AbogaSense') }}</a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('residence_region_id').addEventListener('change', function() {
            const regionId = this.value;
            const communeSelect = document.getElementById('residence_commune_id');

            communeSelect.innerHTML = '<option value="">Cargando comunas...</option>';

            if (regionId) {
                fetch(`/communes-by-region/${regionId}`)
                    .then(response => response.json())
                    .then(communes => {
                        communeSelect.innerHTML = '<option value="">Seleccione una comuna</option>';
                        communes.forEach(commune => {
                            const option = document.createElement('option');
                            option.value = commune.id;
                            option.textContent = commune.name;
                            communeSelect.appendChild(option);
                        });
                    })
                    .catch(() => {
                        communeSelect.innerHTML = '<option value="">Error al cargar comunas</option>';
                    });
            } else {
                communeSelect.innerHTML = '<option value="">Seleccione una comuna</option>';
            }
        });
    </script>

@endsection
