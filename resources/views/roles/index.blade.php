@extends('layouts.app')

@section('title', 'Gestión de Roles - ' . config('app.name', 'Laravel'))

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0 roles-title">
                <i class="bi bi-person-check me-2"></i>{{ __('Roles') }}
            </h3>
            <a href="{{ route('dashboard') }}" class="btn btn-sm roles-back-btn">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Tabla de Roles --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center roles-header">
                <h5 class="mb-0">Listado de Roles</h5>
                <a href="{{ route('roles.create') }}" class="btn btn-sm roles-new-btn">
                    <i class="bi bi-plus-circle"></i> Nuevo Rol
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="roles-table-head">
                            <tr>
                                <th class="text-center roles-table-th">Nombre</th>
                                <th class="text-center roles-table-th">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($roles as $rol)
                                <tr>
                                    <td>{{ $rol->name }}</td>
                                    <td>
                                        <div class="d-flex flex-column flex-md-row justify-content-center gap-2">
                                            @if ($rol->name == 'Super Admin')
                                                <div class="text-danger small">
                                                    <i class="bi bi-exclamation-circle me-1"></i>No puede editar ni eliminar
                                                    este rol por defecto del sistema.
                                                </div>
                                            @else
                                                {{-- Editar --}}
                                                <a href="{{ route('roles.edit', $rol) }}"
                                                    class="btn btn-sm w-100 d-flex align-items-center justify-content-center gap-1 roles-edit-btn">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </a>

                                                {{-- Eliminar --}}
                                                <form action="{{ route('roles.destroy', $rol) }}" method="POST"
                                                    onsubmit="return confirm('¿Estás seguro de eliminar este tenant?')"
                                                    class="w-100">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm w-100 d-flex align-items-center justify-content-center gap-1 roles-delete-btn">
                                                        <i class="bi bi-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-3 text-muted">No hay roles.</td>
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
.roles-title {
    color: #8C2D18;
}
.roles-back-btn {
    background-color: #F5E8D0;
    color: #8C2D18;
}
.roles-header {
    background-color: #8C2D18;
    color: white;
}
.roles-new-btn {
    background-color: #FDF5E5;
    color: #8C2D18;
}
.roles-table-head {
    background-color: #FDF5E5;
}
.roles-table-th {
    color: #8C2D18;
}
.roles-edit-btn {
    background-color: #8C2D18;
    color: white;
}
.roles-delete-btn {
    background-color: #BF8A49;
    color: white;
}
</style>
@endpush
