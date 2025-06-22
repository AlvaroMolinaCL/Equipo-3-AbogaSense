@extends('tenants.default.layouts.panel')

@section('title', 'Ver y editar casos')

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
<div class="container">
    <h2>{{ isset($case) ? 'Editar caso' : 'Nuevo caso' }}</h2>
    <form method="POST" action="{{ isset($case) ? route('cases.update', [$tenantId, $case->id]) : route('cases.store', $tenantId) }}">
        @csrf
        @if(isset($case)) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input name="title" class="form-control" value="{{ old('title', $case->title ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control">{{ old('description', $case->description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="status" class="form-select">
                @foreach(['pendiente', 'en progreso', 'resuelto'] as $estado)
                    <option value="{{ $estado }}" {{ (old('status', $case->status ?? '') == $estado) ? 'selected' : '' }}>
                        {{ ucfirst($estado) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Asignar a</label>
            <select name="user_id" class="form-select">
                <option value="">Sin asignar</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ (old('user_id', $case->user_id ?? '') == $user->id) ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
