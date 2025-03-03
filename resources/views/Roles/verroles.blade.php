@extends('adminlte::page')

@section('title', 'Gestión de Roles')
@section('plugins.Sweetalert2', true)

@section('content_header')
    <b></b>
@stop

@section('content')
<div class='row'> 
    <div class="col-md-12">
            
    <head>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>

    <div class="container-fluid mt-4">
        <div class="shadow-lg p-5 bg-white">
            <div class="card-header text-success text-center">
                <h4 class="mb-0"><i class="fas fa-user-shield"></i> Gestión de Roles</h4>
            </div>

            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#crearRolModal">
                    <i class="fas fa-plus"></i> Crear Rol
                </button>
                <a href="{{ route('roles.index') }}" class="btn btn-success ms-2">
                    <i class="fas fa-users"></i> Ver Roles asignados
                </a>
            </div>

            <div class="table-responsive">
                <table id="rolesTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del Rol</th>
                            <th>Guard Name</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->guard_name }}</td>
                                <td>
                                    <form action="{{ route('verroles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('verroles.edit', $role->id) }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-key"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No hay roles disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="crearRolModal" tabindex="-1" aria-labelledby="crearRolModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearRolModalLabel">Crear Nuevo Rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('verroles.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Rol:</label>
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
                            <button type="submit" class="btn btn-primary">Crear Rol</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#rolesTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json',
                },
                responsive: true,
            });
        });
    </script>
@endsection
