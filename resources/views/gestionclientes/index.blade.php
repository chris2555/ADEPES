@extends('adminlte::page')

@section('title', 'Gestión de Clientes')

@section('content_header')
<h1><b>Listado de Clientes</b></h1>
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
            <h3 class="card-title">Gestión de Clientes</h3>
            <div class="card-tools">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevoClienteModal">
                                <i class="fas fa-plus"></i> Añadir Nuevo
                            </button>
                        </div>
                        </div>

                        <div class="card-body">
                        <div class="table-responsive">
                                <table id="clienteTable"  class="table table-bordered table-hover table-striped table-sm">
                                    <thead>
                                        <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Identidad</th>
                                        <th>Edad</th>
                                        <th>Estado Civil</th>
                                        <th>Género</th>
                                        <th>Teléfono</th>
                                        <th>Email Personal</th>
                                        <th>Email Laboral</th>
                                        <th>Acciones</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    @foreach($personas as $persona)
                                        <tr>
                                        <td>{{ $persona['id_persona'] }}</td>
                                        <td>{{ $persona['nombres_apellidos'] }}</td>
                                        <td>{{ $persona['n_identidad'] }}</td>
                                        <td>{{ $persona['edad'] }}</td>
                                        <td>{{ $persona['estado_civil'] }}</td>
                                        <td>{{ $persona['genero'] }}</td>
                                        <td>{{ $persona['telefono_secundario'] }}</td>
                                        <td>{{ $persona['email_personal'] }}</td>
                                        <td>{{ $persona['email_laboral'] }}</td>
                                        <td>
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm"
                                        onclick="viewModal({{ json_encode($persona) }})">
                                        <i class="bi bi-eye"></i>
                                        </a>
                                            <a href="{{ route('gestionclientes.show', $persona['id_persona'])}}" class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        <form action="{{ route('gestionclientes.destroy', $persona['id_persona']) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                            <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

<!-- Modal para agregar un nuevo cliente -->
<div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel">Información de Clientes</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row" id="viewModalBody">
                                            {{-- El contenido del modal se carga aquí con JavaScript --}}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="modal fade" id="nuevoClienteModal" tabindex="-1" aria-labelledby="nuevoClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoClienteModalLabel">Añadir Nuevo Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="nuevoClienteForm" action="{{ route('gestionclientes.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Primera columna -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="nombres_apellidos" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombres_apellidos" name="nombres_apellidos" required>
                            </div>
                            <div class="mb-3">
                                <label for="n_identidad" class="form-label">Número de Identidad</label>
                                <input type="text" class="form-control" id="n_identidad" name="n_identidad" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                            </div>
                            <div class="mb-3">
                                <label for="edad" class="form-label">Edad</label>
                                <input type="number" class="form-control" id="edad" name="edad" required>
                            </div>
                        </div>

                        <!-- Segunda columna -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" required>
                            </div>
                            <div class="mb-3">
                                <label for="estado_civil" class="form-label">Estado Civil</label>
                                <select class="form-control" id="estado_civil" name="estado_civil">
                                    <option value="Soltero">Soltero</option>
                                    <option value="Casado">Casado</option>
                                    <option value="Divorciado">Divorciado</option>
                                    <option value="Viudo">Viudo</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="genero" class="form-label">Género</label>
                                <select class="form-control" id="genero" name="genero">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tipo_persona" class="form-label">Tipo de persona</label>
                                <select class="form-control" id="tipo_persona" name="tipo_persona">
                                    <option value="Solicitante">Solicitante</option>
                                    <option value="Aval">Aval</option>
                                </select>
                            </div>
                        </div>

                        <!-- Tercera columna -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="email_personal" class="form-label">Email Personal</label>
                                <input type="email" class="form-control" id="email_personal" name="email_personal">
                            </div>
                            <div class="mb-3">
                                <label for="email_laboral" class="form-label">Email Laboral</label>
                                <input type="email" class="form-control" id="email_laboral" name="email_laboral">
                            </div>
                            <div class="mb-3">
                                <label for="telefono_secundario" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono_secundario" name="telefono_secundario">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar Cliente</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
@section('js')
<script src="//cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $(function () {
        $('#clienteTable').DataTable({
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
                buttons: [
                    { text: '<i class="fas fa-copy"></i> COPIAR', extend: 'copy', className: 'btn btn-info' },
                    { text: '<i class="fas fa-file-csv"></i> CSV', extend: 'csv', className: 'btn btn-info' },
                    { text: '<i class="fas fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-info' },
                    { text: '<i class="fas fa-file-pdf"></i> PDF', extend: 'pdf', className: 'btn btn-info' },
                    { text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-info' },
                ]
            });
        });
   
   function viewModal(personas) {
    var modalBody = document.getElementById('viewModalLabel');
    modalBody.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <p><strong>Nombre del cliente:</strong> ${personas.nombres_apellidos}</p>
                <p><strong>Número de identidad:</strong> ${personas.n_identidad || 'No disponible'}</p>
                <p><strong>Fecha de nacimiento:</strong> ${personas.fecha_nacimiento}</p>
                <p><strong>Edad:</strong> ${personas.edad}</p>
                <p><strong>Nacionalidad:</strong> ${personas.nacionalidad || 'No disponible'}</p>
                <p><strong>Estado civil:</strong> ${personas.estado_civil || 'No disponible'}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Género:</strong> ${personas.genero || 'No disponible'}</p>
                <p><strong>Tipo de cliente:</strong> ${personas.tipo_persona}</p>
                <p><strong>Email personal:</strong> ${personas.email_personal}</p>
                <p><strong>Email laboral:</strong> ${personas.email_laboral}</p>
                <p><strong>Teléfono secundario:</strong> ${personas.telefono_secundario}</p>
                <p><strong>Creado en:</strong> ${personas.creado_en ? new Date(personas.creado_en).toLocaleString() : 'No disponible'}</p>
                <p><strong>Modificado por:</strong> ${personas.modificado_por || 'No disponible'}</p>
                <p><strong>Modificado en:</strong> ${personas.modificado_en ? new Date(personas.modificado_en).toLocaleString() : 'No disponible'}</p>
            </div>
        </div>
    `;

    var viewModalElement = new bootstrap.Modal(document.getElementById('view'));
    viewModalElement.show();
}
document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                Swal.fire({
                    title: '¿Está seguro?',
                    text: "Esta acción no se puede deshacer",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('form').submit();
                    }
                });
            });
        });
    });
    </script>

@if(session('success'))
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

    @if(session('error'))
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