@extends('adminlte::page')

@section('title', 'Editar Permiso')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('permisos.index') }}">Gestión de Permisos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Permiso</li>
        </ol>
    </nav>
    <h1>Editar Permiso</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('permisos.update', $permission->id) }}">
                @csrf
                @method('PUT') {{-- Directiva para indicar que es una petición PUT --}}

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Permiso:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $permission->name) }}" autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="guard_name" class="form-label">Guard Name:</label>
                    <select class="form-select @error('guard_name') is-invalid @enderror" id="guard_name" name="guard_name">
                        <option value="web" {{ old('guard_name', $permission->guard_name) == 'web' ? 'selected' : '' }}>web</option>
                        <option value="api" {{ old('guard_name', $permission->guard_name) == 'api' ? 'selected' : '' }}>api</option>
                    </select>
                    @error('guard_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <a href="{{ route('permisos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
@stop