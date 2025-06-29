@extends('tenants.default.layouts.panel')

@section('title', 'Gestión de Casos - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-journal-text me-2"></i>{{ __('Casos') }}
            </h3>
            <a href="{{ route('dashboard') }}" class="btn btn-sm"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                       color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                       border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        {{-- Tabla de Casos --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }};
                       color: {{ tenantSetting('button_banner_text_color', 'white') }};">
                <h5 class="mb-0">Listado de Casos</h5>
                <a href="{{ route('cases.create') }}" class="btn btn-sm"
                    style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};
                           color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                    <i class="bi bi-plus-circle"></i> Nuevo Caso
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: {{ tenantSetting('button_banner_text_color', '#FDF5E5') }};">
                            <tr>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Título</th>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Estado</th>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Asignado</th>
                                <th class="text-center" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($cases as $case)
                                <tr>
                                    <td>{{ $case->title }}</td>
                                    <td>
                                        <span class="badge"
                                            style="background-color: {{ tenantSetting('button_color_sidebar', '#BF8A49') }};
                                                   color: white;">
                                            {{ ucfirst($case->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $case->user->name ?? 'Sin asignar' }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                                            <a href="{{ route('cases.edit', $case->id) }}"
                                                class="btn btn-sm d-flex align-items-center justify-content-center gap-1"
                                                style="background-color: {{ tenantSetting('color_tables', '#8C2D18') }}; color: white; min-width: 100px;">
                                                <i class="bi bi-pencil"></i> Editar
                                            </a>
                                            <form action="{{ route('cases.destroy', $case->id) }}" method="POST"
                                                class="d-inline-block form-eliminar-caso">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm d-flex align-items-center justify-content-center gap-1"
                                                    style="background-color: {{ tenantSetting('button_color_sidebar', '#BF8A49') }}; color: white; min-width: 100px;">
                                                    <i class="bi bi-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">No hay casos registrados.</td>
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
            document.querySelectorAll('form.form-eliminar-caso').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'Esta acción no se puede deshacer.',
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