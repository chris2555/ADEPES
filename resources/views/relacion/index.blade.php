@extends('adminlte::page')

@section('title', 'Gestión de Relaciones de Solicitud')
@section('plugins.Sweetalert2', true)

@section('content_header')

@stop

@section('content')

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
                <h4 class="mb-0"><i class="fas fa-file-contract"></i> Gestión de Relaciones de Solicitud</h4>

            </div>

            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert">
                    <i class="fas fa-plus"></i> Nueva Relación
                </button>
            </div>

            <div class="d-flex justify-content-end">
                <div class="table-responsive ms-auto">
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
                responsive: true,
                autoWidth: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json',
                    search: "Buscar:"
                },
                dom: '<"row d-flex justify-content-between align-items-center"<"col-md-3"l><"col-md-6"B><"col-md-3 text-end"f>>rtip',
                buttons: [{
                        extend: 'copy',
                        text: '<i class="fas fa-copy"></i> Copiar',
                        className: 'btn btn-secondary text-dark'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        className: 'btn btn-success text-dark'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        className: 'btn btn-danger text-dark'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        className: 'btn btn-info text-dark'
                    }
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

@section('css')
    <style>
        #relacionTable_wrapper {
            margin-left: auto;
            width: 96%;
            /* Ajusta este valor según lo que necesites */
        }

        .container-fluid {
            width: 100vw;
            height: 100vh;
            padding: 0px;
        }

        .dt-buttons .btn {
            color: success !important;
            border: none !important;
        }

        .dt-buttons .btn:hover {
            filter: brightness(85%);
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table {
            font-size: 24px;
        }

        .dt-buttons .btn {
            margin: 5px;
            font-size: 14px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .dt-buttons .btn:hover {
            filter: brightness(85%);
        }

        .btn-sm {
            border-radius: 5px;
        }
    </style>


@stop

@stop
