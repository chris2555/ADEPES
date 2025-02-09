<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<div class="container">


    <form action="#" method="POST"> {{-- En un ejemplo real, action="{{ route('roles.permissions.update') }}" --}}
        @csrf

        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Permisos</th>
                    <th class="text-center">Administrador</th>
                </tr>
            </thead>
            <tbody>
                @php
                    // Datos FALSOS para roles (solo para este ejemplo)
                    $rolesFalsos = [
                        ['id' => 1, 'name' => 'Administrador']
                    ];

                    // Datos FALSOS para permisos (solo para este ejemplo)
                    $permisosFalsos = [
                        ['id' => 1, 'name' => 'ver-usuarios'],
                        ['id' => 2, 'name' => 'editar-usuarios'],
                        ['id' => 3, 'name' => 'borrar-usuarios'],
                        ['id' => 4, 'name' => 'crear-usuarios'],
                        ['id' => 5, 'name' => 'ver-roles'],
                        ['id' => 6, 'name' => 'editar-roles'],
                        ['id' => 7, 'name' => 'crear-roles'],
                        ['id' => 8, 'name' => 'ver-solicitudes'],
                        ['id' => 9, 'name' => 'editar-solicitudes'],
                        ['id' => 10, 'name' => 'ver-pagos'],
                    ];

                    // Asignación FALSA de permisos a roles (solo para este ejemplo)
                    $permisosAsignadosFalsos = [
                        1 => ['ver-usuarios', 'editar-usuarios', 'borrar-usuarios', 'crear-usuarios', 'ver-roles', 'editar-roles', 'crear-roles', 'ver-solicitudes', 'editar-solicitudes', 'ver-pagos'], // Admin tiene todos
                        2 => ['ver-usuarios', 'editar-usuarios', 'ver-solicitudes'], // Editor tiene algunos
                        3 => ['ver-usuarios', 'ver-solicitudes', 'ver-pagos'], // Usuario básico tiene algunos
                    ];
                @endphp

                @foreach($permisosFalsos as $permiso)
                    <tr>
                        <th scope="row">{{ $permiso['name'] }}</th>
                        @foreach($rolesFalsos as $roleFalso)
                            <td class="text-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[{{ $roleFalso['id'] }}][]" value="{{ $permiso['name'] }}"
                                           @if(isset($permisosAsignadosFalsos[$roleFalso['id']]) && in_array($permiso['name'], $permisosAsignadosFalsos[$roleFalso['id']])) checked @endif
                                           id="permission_{{ $permiso['id'] }}_role_{{ $roleFalso['id'] }}">
                                </div>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Guardar Permisos</button>
    </form>
</div>