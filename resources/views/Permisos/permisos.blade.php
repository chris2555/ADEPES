@extends('adminlte::page')

@section('title', 'Gestión de Permisos')

@section('content_header')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<div class="d-flex justify-content-between align-items-center mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gestión de Permisos</li>
        </ol>
    </nav>
    <div>
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#crearPermisoModal"> {{-- Botón que abre el modal --}}
            Crear Permiso
        </button>
    </div>
</div>

@stop

@section('content')
    <div class="table-responsive">
        <table id="permissionsTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Permiso</th>
                    <th>Guard Name</th>
                    <th>Acciones</th> {{-- Nueva columna Acciones --}}
                </tr>
            </thead>
            <tbody>
                @forelse ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->guard_name }}</td>
                        <td>
                            <a href="{{ route('permisos.edit', $permission->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form id="deleteForm{{ $permission->id }}" action="{{ route('permisos.destroy', $permission->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"> {{-- Botón de Borrar MODIFICADO a type="submit" --}}
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No hay permisos disponibles.</td> {{-- colspan actualizado a 4 --}}
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal para Crear Permiso --}}
    <div class="modal fade" id="crearPermisoModal" tabindex="-1" aria-labelledby="crearPermisoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearPermisoModalLabel">Crear Nuevo Permiso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('permisos.store') }}"> {{-- Formulario POST que envía a 'permisos.store' --}}
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Permiso:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" autofocus>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="guard_name" class="form-label">Guard Name:</label>
                            <select class="form-select @error('guard_name') is-invalid @enderror" id="guard_name" name="guard_name">
                                <option value="web" {{ old('guard_name') == 'web' ? 'selected' : '' }}>web</option>
                                <option value="api" {{ old('guard_name') == 'api' ? 'selected' : '' }}>api</option>
                            </select>
                            @error('guard_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Crear Permiso</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de Confirmación de Borrado de Permiso ELIMINADO --}}

@stop

@section('js')
    <script>
        var table = new DataTable('#permissionsTable', {
            language: {
                url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json',
            },
        });

        // Función JavaScript confirmDeletePermission ELIMINADA

    </script>
@endsection