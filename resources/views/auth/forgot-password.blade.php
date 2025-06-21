@extends('layouts.guest')

@section('title', 'Recuperar Contraseña - ' . config('app.name', 'Laravel'))

@section('content')
    <div class="container py-5 d-flex align-items-center justify-content-center forgot-min-height">
        <div class="col-md-8 col-lg-6">
            <div class="shadow-lg rounded-4 overflow-hidden forgot-card">

                <!-- Logo -->
                <div class="text-center py-2 forgot-logo-bg">
                    <img src="{{ asset('images/abogasense2.png') }}" alt="Logo del despacho"
                        class="img-fluid mb-2 forgot-logo-img">
                </div>

                <div class="p-5 bg-white">

                    <!-- Encabezado -->
                    <div class="text-center mb-4">
                        <h3 class="forgot-title">
                            <i class="bi bi-envelope-check-fill me-2"></i> ¿Olvidaste tu contraseña?
                        </h3>
                        <p class="text-muted">Ingresa tu correo y te enviaremos un enlace para restablecerla.</p>
                    </div>

                    <!-- Mensaje de estado -->
                    @if (session('status'))
                        <div class="alert alert-success text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Correo -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Por ejemplo: miemail@gmail.com" id="email" name="email"
                                value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botón -->
                        <div class="d-grid">
                            <button type="submit" class="btn forgot-btn">
                                <i class="bi bi-send-check me-1"></i> Enviar enlace
                            </button>
                        </div>

                        <!-- Link de regreso al login -->
                        <div class="mt-4 text-center">
                            <small class="text-muted">¿Recordaste tu contraseña?</small><br>
                            <a href="{{ route('login') }}" class="text-decoration-none forgot-link">
                                Iniciar sesión
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .forgot-min-height { min-height: 100vh; }
    .forgot-card { background-color: #fdf5e5; border-left: 10px solid #6B3A2C; }
    .forgot-logo-bg { background-color: #fdf5e5; }
    .forgot-logo-img { max-width: 250px; }
    .forgot-title { color: #4A1D0B; }
    .forgot-btn { background-color: #4A1D0B; color: #fff; }
    .forgot-link { color: #4A1D0B; }
</style>
@endpush
