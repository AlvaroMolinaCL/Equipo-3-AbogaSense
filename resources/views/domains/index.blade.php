@extends('layouts.app')

@section('title', 'Gestión de Dominios Personalizados - ' . config('app.name', 'Laravel'))

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0" style="color: #8C2D18;">
                <i class="bi bi-globe-americas me-2"></i>{{ __('Dominios') }}
            </h3>
            <a href="{{ route('dashboard') }}" class="btn btn-sm" style="background-color: #F5E8D0; color: #8C2D18;">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Tabla de Dominios --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: #8C2D18; color: white;">
                <h5 class="mb-0">Listado de Dominios</h5>
                <a href="{{ route('domains.create') }}" class="btn btn-sm"
                    style="background-color: #FDF5E5; color: #8C2D18;">
                    <i class="bi bi-plus-circle"></i> Nuevo Dominio
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #FDF5E5;">
                            <tr>
                                <th class="text-center" style="color: #8C2D18;">Dominio Personalizado</th>
                                <th class="text-center" style="color: #8C2D18;">Tenant</th>
                                <th class="text-center" style="color: #8C2D18;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($domains as $domain)
                                <tr>
                                    <td>{{ $domain->domain }}</td>
                                    <td>{{ $domain->tenant_id . '.' . config('app.domain') }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                                            {{-- Editar --}}
                                            <a href="{{ route('domains.edit', $domain) }}"
                                                class="btn btn-sm d-flex align-items-center justify-content-center gap-1"
                                                style="background-color: #8C2D18; color: white; min-width: 100px;">
                                                <i class="bi bi-pencil"></i> Editar
                                            </a>

                                            {{-- Eliminar --}}
                                            <form action="{{ route('domains.destroy', $domain) }}" method="POST" class="form-eliminar-dominio">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm d-flex align-items-center justify-content-center gap-1"
                                                    style="background-color: #BF8A49; color: white; min-width: 100px;">
                                                    <i class="bi bi-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-3 text-muted">No hay dominios.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('form.form-eliminar-dominio').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡Esta acción no se puede deshacer!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#8C2D18',
                        cancelButtonColor: '#BF8A49',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush