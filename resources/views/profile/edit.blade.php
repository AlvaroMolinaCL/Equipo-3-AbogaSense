@extends('layouts.app')

@section('title', 'Mi Perfil - ' . config('app.name', 'Laravel'))

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="fw-bold mb-0 profile-title">
                <i class="bi bi-person me-2"></i>{{ __('Perfil') }}
            </h3>
            <a href="{{ route('dashboard') }}" class="btn btn-sm profile-back-btn">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        <div class="card shadow border-0 mb-4 profile-card">
            <div class="card-body p-4">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card shadow border-0 mb-4 profile-card">
            <div class="card-body p-4">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="card shadow border-0 profile-card">
            <div class="card-body p-4">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
.profile-title {
    color: #8C2D18;
}
.profile-back-btn {
    background-color: #F5E8D0;
    color: #8C2D18;
}
.profile-card {
    background-color: #FDF5E5;
}
</style>
@endpush
