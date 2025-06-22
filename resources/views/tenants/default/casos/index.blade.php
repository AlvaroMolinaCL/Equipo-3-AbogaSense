@extends('tenants.default.layouts.panel')

@section('title', 'Casos')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
<div class="container">
    <h2>Casos</h2>
    <a href="{{ route('cases.create') }}" class="btn btn-primary mb-3">Nuevo caso</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Estado</th>
                <th>Asignado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cases as $case)
                <tr>
                    <td>{{ $case->title }}</td>
                    <td>{{ $case->status }}</td>
                    <td>{{ $case->user->name ?? 'Sin asignar' }}</td>
                    <td>
                        <a href="{{ route('cases.edit', $case->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
