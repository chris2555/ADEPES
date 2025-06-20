@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1><b>Listado de Usuarios</b></h1>
    <hr>
@stop

@section('content')

    <head>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Usuarios Registrados</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-success me-2" data-bs-toggle="modal"
                            data-bs-target="#nuevoUsuarioModal">
                            Nuevo Usuario
                        </button>
                        <a href="{{ route('roles.index') }}" class="btn btn-success">
                            Ver Roles asignados
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="user" class="table table-bordered table-hover table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center" data-order="asc">ID_Usuario</th>
                                    <th style="text-align: center">Nombre</th>
                                    <th style="text-align: center">Email</th>
                                    <th style="text-align: center">Fecha de Creación</th>
                                    <th style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(collect($users)->sortBy(fn($p) => (int) $p['id']) as $user)
                                    <tr>
                                        <td style="text-align: center" data-order="asc">{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td style="text-align: center">{{ $user->created_at->format('d/m/Y') }}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-success btn-sm" style="margin-right: 5px;">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    style="display:inline;" id="delete-form-{{ $user->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $user->id }})">
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
                        <script>
                            function sortTable(columnIndex) {
                                let table = document.getElementById("user");
                                let rows = Array.from(table.rows).slice(1); // Omitimos el encabezado
                                let sortedRows = rows.sort((a, b) => {
                                    return a.cells[columnIndex].innerText - b.cells[columnIndex].innerText;
                                });
                        </script>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="nuevoUsuarioModal" tabindex="-1" aria-labelledby="nuevoUsuarioModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="nuevoUsuarioModalLabel">Nuevo Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="nuevoUsuarioForm" action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nombre de usuario (*)</label>
                                        <input type="text" class="form-control" id="name" name="name"  placeholder="Ingresa su nombre y apellido" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo Electrónico</label>
                                        <input type="text" class="form-control " id="email" name="email"  placeholder="Ingresa su correo electronico" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-dark" id="password"
                                                name="password" required placeholder="Contraseña Temporal"
                                                title="Debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un símbolo"
                                                style="max-width: 450px;">
                                            <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                                                <i class="bi bi-eye" id="iconPwd"></i>
                                            </button>
                                        </div>
                                    </div>


                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-dark" name="password"
                                                placeholder="Confirmar Contraseña Temporal"
                                                id="confirm_password" name="confirm_password" required
                                                style="max-width: 450px;">
                                            <button type="button" id="toggleConfirmPassword"
                                                class="btn btn-outline-secondary">
                                                <i class="bi bi-eye" id="iconConfirmPwd"></i>
                                            </button>
                                        </div>
                                    </div>




                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" form="nuevoUsuarioForm" class="btn btn-primary"
                            id="submitBtn">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@stop

@section('css')
    <style>
        .dataTables_wrapper .dt-buttons {
            background-color: transparent;
            border: none;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 15px;
            padding-right: 20px;
            /* Añadido margen adicional */
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-info {
            background-color: #17a2b8;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .dataTables_wrapper .dt-buttons {
            background-color: transparent;
            border: none;
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 10px;
        }


        .btn-warning {
            background-color: #ffc107;
            color: #212529;
            margin-left: 5px;
            /* Mueve el botón de editar a la derecha */
        }

        .dataTables_paginate {
            text-align: right !important;
            /* Alinea la paginación a la derecha */
        }

        .dt-buttons {
            margin-bottom: 10px;
            /* Agrega separación a los botones de impresión */
        }

        .is-valid {
            border: 3px solid #198754;
        }

        .is-invalid {
            border: 3px solid #dc3545;
        }
    </style>
@stop

@section('js')

    <script>
        const form = document.getElementById('nuevoUsuarioForm');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm_password');
        const submitBtn = document.getElementById('submitBtn');
        const togglePassword = document.getElementById('togglePassword');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

        // Función para validar fortaleza de la contraseña
        const strongPwd = pwd =>
            /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()[\]{};:'",.<>/?\\|`~\-_=+]).{8,}$/.test(pwd);

        // Actualiza el estilo del input según validez
        function setInputStatus(input, isValid) {
            if (isValid) {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            } else {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
            }
        }

        // Activa o desactiva el botón según validación
        function toggleSubmitBtn() {
            const validPwd = strongPwd(passwordInput.value);
            const match = passwordInput.value === confirmPasswordInput.value;
            submitBtn.disabled = !(validPwd && match);
        }

        // Mostrar/ocultar contraseña con Bootstrap Icons
        function toggleVisibility(input, toggleBtn, icon) {
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye';
            }
        }

        togglePassword.addEventListener('click', () => {
            toggleVisibility(passwordInput, togglePassword);
        });
        toggleConfirmPassword.addEventListener('click', () => {
            toggleVisibility(confirmPasswordInput, toggleConfirmPassword);
        });

        passwordInput.addEventListener('input', () => {
            setInputStatus(passwordInput, strongPwd(passwordInput.value));
            toggleSubmitBtn();
        });

        confirmPasswordInput.addEventListener('input', () => {
            setInputStatus(confirmPasswordInput, confirmPasswordInput.value === passwordInput.value);
            toggleSubmitBtn();
        });

        form.addEventListener('submit', e => {
            const validPwd = strongPwd(passwordInput.value);
            const match = passwordInput.value === confirmPasswordInput.value;

            setInputStatus(passwordInput, validPwd);
            setInputStatus(confirmPasswordInput, match);

            if (!match) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Las contraseñas no coinciden.',
                });
                return;
            }

            if (!validPwd) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'La contraseña debe tener mínimo 8 caracteres, 1 mayúscula, 1 número y 1 carácter especial.',
                });
            }
        });
    </script>


    <script src="//cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            $('#user').DataTable({
                "pageLength": 5,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "language": {
                    "search": "Buscador:",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total de entradas)",
                    "lengthMenu": "Mostrar _MENU_ Configuraciones",
                    "url": "//cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                dom: '<"row d-flex justify-content-between align-items-center"<"col-md-3"l><"col-md-6 text-center"B><"col-md-3 d-flex justify-content-end"f>>' +
                    'rt' +
                    '<"row d-flex align-items-center mt-2"<"col-md-6 text-start"i><"col-md-6 d-flex justify-content-end"p>>',
                buttons: [{
                        text: '<i class="fas fa-copy"></i> COPIAR',
                        extend: 'copy',
                        className: 'btn btn-info'
                    },
                    {
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        extend: 'csv',
                        className: 'btn btn-info'
                    },
                    {
                        text: '<i class="fas fa-print"></i> IMPRIMIR',
                        extend: 'print',
                        className: 'btn btn-info'
                    },
                    {
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        extend: 'pdf',
                        className: 'btn btn-info'
                    },
                    {
                        text: '<i class="fas fa-file-excel"></i> EXCEL',
                        extend: 'excel',
                        className: 'btn btn-info'
                    },
                ]
            });
        });

        function confirmDelete(userId) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Este registro será eliminado permanentemente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        }
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif
@stop
