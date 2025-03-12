@extends('adminlte::page')

@section('title', 'Gestión de Relaciones de Solicitud')
@section('plugins.Sweetalert2', true)

@section('content_header')

@stop

@section('content')
<head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
</head>

<div class='row'> 
    <div class="col-md-12">
            <div class="card-header">
                <div class="container-fluid mt-4">
                    <div class="shadow-lg p-5 bg-white">
                         <div class="card-header text-success text-center">
            <h4 class="mb-0"><i class="fas fa-file-contract"></i> Gestión de Relaciones de Solicitud</h4>
                        </div>
                        <div class="card-header d-flex justify-content-end">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevoClienteModal">
                                <i class="fas fa-plus"></i> Añadir Nuevo
                            </button>
                        </div>

                        <!-- Contenedor de la tabla -->
                        <div class="card-body">
                            <div class="table-responsive table-hover table-striped table-sm">
                                <table id="relacionTable">
                                    <thead>
                                        <tr>
                                <th>ID Relación</th>
                                <th>ID Solicitud</th>
                                <th>Nombre</th>
                                <th>Cónyuge</th>
                                <th>Ingresos</th>
                                <th>Egresos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($solicitudes as $solicitud)
                                <tr>
                                    <td>{{ $solicitud['id_relacion'] }}</td>
                                    <td>{{ $solicitud['id_solicitud'] }}</td>
                                    <td>{{ $solicitud['nombre_persona'] }}</td>
                                    <td>{{ $solicitud['nombre_conyuge'] }}</td>
                                    <td>{{ $solicitud['ingresos'] }}</td>
                                    <td>{{ $solicitud['egresos'] }}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-success btn-sm"
                                            onclick="viewModal({{ json_encode($solicitud) }})">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('relacion.show', $solicitud['id_relacion'])}}" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('relacion.destroy', $solicitud['id_relacion']) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-warning btn-sm delete-btn">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

    <div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Información de Solicitud</h5>
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



    {{-- Modal para Insertar Nueva Solicitud --}}
    <div class="modal fade" id="insert" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertModalLabel">Insertar Nueva Relación de Solicitud</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insertForm" action="{{ route('relacion.store') }}" method="POST">
                        @csrf
                        <div class="row">

                            <x-adminlte-select name="id_solicitud" label="Seleccionar Solicitud" fgroup-class="mb-3"
                                required>
                                <option value="">Seleccione una solicitud</option>
                                @foreach ($solicitudesp as $solicitud)
                                    <option value="{{ $solicitud->id_solicitud }}">
                                        ID: {{ $solicitud->id_solicitud }} - Monto:
                                        {{ number_format($solicitud->monto, 2) }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>


                            <div class="col-md-6">
                                <x-adminlte-select name="id_persona" label="Seleccionar Persona" fgroup-class="mb-3"
                                    required>
                                    <option value="">Seleccione una persona</option>
                                    @foreach ($personas as $persona)
                                        <option value="{{ $persona->id_persona }}">
                                            {{ $persona->nombres_apellidos }} - {{ $persona->n_identidad }}
                                        </option>
                                    @endforeach
                                </x-adminlte-select>


                                <x-adminlte-select name="id_ingresos" label="Seleccione un ingreso" fgroup-class="mb-3"
                                    required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($ingresos as $ingreso)
                                        <option value="{{ $ingreso->id_ingresos }}">{{ $ingreso->id_ingresos }} -
                                            {{ $ingreso->total_ingresos }}</option>
                                    @endforeach
                                </x-adminlte-select>


                                <x-adminlte-select name="id_aval1" label="Seleccionar Aval 1" fgroup-class="mb-3">
                                    <option value="">Seleccione un aval</option>
                                    @foreach ($avales as $aval)
                                        <option value="{{ $aval->id_persona }}">
                                            {{ $aval->nombres_apellidos }} - {{ $aval->n_identidad }}
                                        </option>
                                    @endforeach
                                </x-adminlte-select>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="id_conyuge">ID Cónyuge</label>
                                    <select name="id_conyuge" class="form-control" required>
                                        <option value="">Selecciona un cónyuge</option>
                                        @foreach ($conyuges as $conyuge)
                                            <option value="{{ $conyuge->id_conyuge }}">
                                                {{ $conyuge->nombres_conyuge }} - {{ $conyuge->identidad_conyuge }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <x-adminlte-select name="id_egresos" label="Seleccione un egreso" fgroup-class="mb-3"
                                    required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($egresos as $egreso)
                                        <option value="{{ $egreso->id_egresos }}">{{ $egreso->id_egresos }} -
                                            {{ $egreso->total_egresos }}</option>
                                    @endforeach
                                </x-adminlte-select>


                                <x-adminlte-select name="id_aval2" label="Seleccionar Aval 2" fgroup-class="mb-3">
                                    <option value="">Seleccione un aval</option>
                                    @foreach ($avales as $aval)
                                        <option value="{{ $aval->id_persona }}">
                                            {{ $aval->nombres_apellidos }} - {{ $aval->n_identidad }}
                                        </option>
                                    @endforeach
                                </x-adminlte-select>

                                <x-adminlte-select name="id_aval3" label="Seleccionar Aval 3" fgroup-class="mb-3">
                                    <option value="">Seleccione un aval</option>
                                    @foreach ($avales as $aval)
                                        <option value="{{ $aval->id_persona }}">
                                            {{ $aval->nombres_apellidos }} - {{ $aval->n_identidad }}
                                        </option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <x-adminlte-button label="Cancelar" data-bs-dismiss="modal" class="btn-secondary" />
                            <x-adminlte-button class="btn-flat" type="submit" id="btnGuardar" label="Guardar Relación"
                                theme="success" icon="fas fa-lg fa-save" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#relacionTable').DataTable({ // Inicializa DataTables en tu tabla "relacionTable"
                pageLength: 5,
                responsive: true,
                autoWidth: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json',
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ entradas",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    infoEmpty: "Mostrando 0 a 0 de 0 entradas",
                    infoFiltered: "(filtrado de _MAX_ entradas en total)",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    }
    },
    dom: '<"row d-flex justify-content-between"<"col-md-3"l><"col-md-3 text-end"f>>' +
         '<"row"<"col-md-12"B>>' +
         'rtip',
    buttons: [
        { text: '<i class="fas fa-copy"></i> COPIAR', extend: 'copy', className: 'btn btn-dark' },
      { text: '<i class="fas fa-file-csv"></i> CSV', extend: 'csv', className: 'btn btn-info' },
      { text: '<i class="fas fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-warning' },
      { text: '<i class="fas fa-file-pdf"></i> PDF', extend: 'pdf', className: 'btn btn-danger' },
      { text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-success' },
    ]
            });
        });

        function viewModal(solicitud) {
            var modalBody = document.getElementById('viewModalBody');
            modalBody.innerHTML = `
        <div class="col-md-6">
            <p><strong>Nombre del Solicitante:</strong> ${solicitud.nombre_persona}</p>
            <p><strong>Cónyuge:</strong> ${solicitud.nombre_conyuge || 'No disponible'}</p>
            <p><strong>Ingresos:</strong> ${solicitud.ingresos}</p>
            <p><strong>Egresos:</strong> ${solicitud.egresos}</p>
            <p><strong>Aval 1:</strong> ${solicitud.nombre_aval1 || 'No disponible'}</p>
            <p><strong>Aval 2:</strong> ${solicitud.nombre_aval2 || 'No disponible'}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Aval 3:</strong> ${solicitud.nombre_aval3 || 'No disponible'}</p>
            <p><strong>Creado por:</strong> ${solicitud.creado_por}</p>
            <p><strong>Creado en:</strong> ${solicitud.creado_en ? new Date(solicitud.creado_en).toLocaleString() : 'No disponible'}</p>
            <p><strong>Modificado por:</strong> ${solicitud.modificado_por || 'No disponible'}</p>
            <p><strong>Modificado en:</strong> ${solicitud.modificado_en ? new Date(solicitud.modificado_en).toLocaleString() : 'No disponible'}</p>
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
@stop

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

@section('css')
    <style>

#relacionTable_wrapper .btn {
     
     justify-content: center;/*Centrar los botenes */
     gap: 10px;/*Espaciado entre botenes*/
     margin-bottom: 15px; /*Separar botones de la tabla*/
   }

   #relacionTable_wrapper .dt-buttons .btn {
        min-width: 150px;
        margin-right: 10px;
        border-radius: 4px;
        padding: 5px 15px;
        font-size: 15px;
}
        #relacionTable_wrapper {
            width: 96%;
            /* Ajusta este valor según lo que necesites */
        }

        .container-fluid {
            width: 100vw;
            height: 100vh;
            padding: 0px;
        }

    </style>
@stop


