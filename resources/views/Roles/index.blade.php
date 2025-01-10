@extends('adminlte::page')

@section('title', 'Roles')

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
    <h1>Roles</h1>
    <a href="{{ route('roles.create') }}" class="btn btn-info">
        Asignar roles
    </a>
</div>

@stop

@section('content')
    <div class="table-responsive">
        <table id="roles" class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>nombre</th>
                    <th>Email</th>
                    <th>role</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->first()->name}}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay usuarios disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @stop

    @section('js')
    <script>
        var table = new DataTable('#roles', {
            language: {
                url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json',
            },
        });
    </script>
@endsection