@extends('adminlte::page')

@section('title', 'Editar Rol')

@section('content_header')
    <h1>Editar Rol: {{ $role->name }}</h1>
@stop

@section('content')
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>

    <div class="container">
        <form action="{{ route('verroles.update', $role->id) }}" method="POST"> {{-- Form action to update permissions, pass role ID --}}
            @csrf
            @method('PUT') {{-- Use PUT method for updates --}}

            <table class="table table-bordered table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Permisos</th>
                        <th class="text-center">{{ $role->name }}</th> {{-- Dynamic role name as header --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission) {{-- Iterate through real permissions passed from controller --}}
                        <tr>
                            <th scope="row">{{ $permission->name }}</th>
                            <td class="text-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                           @if($role->permissions->contains('name', $permission->name)) checked @endif {{-- Check if role has permission --}}
                                           id="permission_{{ $permission->id }}">
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Guardar Permisos</button>
            <a href="{{ route('verroles.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@stop

@section('js')
    <script>
        // Optional: If you want to add any custom JS for this view
    </script>
@endsection