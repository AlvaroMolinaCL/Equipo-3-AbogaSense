@extends('layouts.app')

@section('title', 'Gestión de Usuarios - ' . config('app.name', 'Laravel'))

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0 users-title">
                <i class="bi bi-people me-2"></i>{{ __('Usuarios') }}
            </h3>
            <a href="{{ route('dashboard') }}" class="btn btn-sm users-btn-back">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Tabla de Usuarios --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center users-card-header">
                <h5 class="mb-0">Listado de Usuarios</h5>
                <a href="{{ route('users.create') }}" class="btn btn-sm users-btn-new">
                    <i class="bi bi-plus-circle"></i> Nuevo Usuario
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 users-table">
                        <thead>
                            <tr>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Rol</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span class="badge users-badge-role">
                                                {{ $role->name }}
                                            </span>{{ !$loop->last ? ' ' : '' }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($user->email == Auth::user()->email)
                                            {{-- Editar --}}
                                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                                                <a href="{{ route('profile.edit', $user) }}"
                                                    class="btn btn-sm d-flex align-items-center justify-content-center gap-1 users-btn-edit">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </a>
                                            </div>
                                        @else
                                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                                                {{-- Editar --}}
                                                <a href="{{ route('users.edit', $user) }}"
                                                    class="btn btn-sm d-flex align-items-center justify-content-center gap-1 users-btn-edit">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </a>

                                                {{-- Eliminar --}}
                                                @if ($user->id !== $firstSuperAdminId)
                                                    {{-- Mostrar botón eliminar --}}
                                                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                        onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm d-flex align-items-center justify-content-center gap-1 users-btn-delete">
                                                            <i class="bi bi-trash"></i> Eliminar
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">No hay usuarios.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .users-title { color: #8C2D18; }
    .users-btn-back { background-color: #F5E8D0; color: #8C2D18; }
    .users-card-header { background-color: #8C2D18; color: white; }
    .users-btn-new { background-color: #FDF5E5; color: #8C2D18; }
    .users-table thead { background-color: #FDF5E5; }
    .users-table th { color: #8C2D18; }
    .users-badge-role { background-color: #BF8A49; color: white; }
    .users-btn-edit { background-color: #8C2D18; color: white; min-width: 100px; }
    .users-btn-delete { background-color: #BF8A49; color: white; min-width: 100px; }
</style>
@endpush