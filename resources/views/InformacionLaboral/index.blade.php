@extends('adminlte::page')

@section('title', 'Gestión de Informacion Laboral')
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
                <h4 class="mb-0"><i class="fas fa-file-contract"></i> Gestión de Informacion Laboral</h4>

            </div>

            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert">
                    <i class="fas fa-plus"></i> Nueva Informacio Laboral
                </button>
            </div>

            <div class="d-flex justify-content-end">
                <div class="table-responsive ms-auto">
                    <table id="InformacionLaboralTable">
                        <thead>
                            <tr>
                                <th>ID Informacion Laboral</th>
                                <th>Id Persona</th>
                                <th>Profesion u oficio</th>
                                <th>actividad</th>
                                <th>Patrono/Negocio</th>
                                <th>Tiempo de laborar </th>
                                <th>Estado del Credito </th>
                                
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($InformacionLaboral as $informacionlaboral)
                            
                                <tr>
                                    <td>{{ $informacionlaboral['id_informacion_laboral'] }}</td>
                                    <td>{{ $informacionlaboral['id_persona'] }}</td>
                                    <td>{{ $informacionlaboral['profesion_oficio'] }}</td>
                                    <td>{{ $informacionlaboral['actividad'] }}</td>
                                    <td>{{ $informacionlaboral['patrono_negocio'] }}</td>
                                    <td>{{ $informacionlaboral['tiempo_laborar'] }}</td>
                                    <td>{{ $informacionlaboral['estado_credito'] }}</td>
                                    
                                   
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-success btn-sm"
                                            onclick="viewModal({{ json_encode($informacionlaboral) }})">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('informacionlaboral.show', $informacionlaboral['id_informacion_laboral'])}}" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('informacionlaboral.destroy', $informacionlaboral['id_informacion_laboral']) }}" method="POST" class="d-inline delete-form">
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
                    <h5 class="modal-title" id="viewModalLabel">Información Laboral</h5>
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

<!-- Modal para Insertar Nueva Información Laboral -->
<div class="modal fade" id="insert" tabindex="-1" aria-labelledby="insertinformacionlaboralLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertinformacionlaboralLabel">Agregar Nueva Información Laboral</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="insertinformacionlaboralForm" action="{{ route('informacionlaboral.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">

                            <x-adminlte-input name="id_persona" label="Identificación" fgroup-class="mb-3" placeholder="Ingrese ID" required />
                            <x-adminlte-input name="profesion_oficio" label="Profesión u Oficio" fgroup-class="mb-3" placeholder="Ingrese su profesión u oficio" required />
                            <x-adminlte-input name="actividad" label="Nombre de Actividad" fgroup-class="mb-3" placeholder="Ingrese la Actividad" required />
                            <x-adminlte-input name="ingresos_negocio" label="Ingresos del Negocio" fgroup-class="mb-3" placeholder="Ingrese ingresos" type="number" step="0.01" />
                            <x-adminlte-input name="direccion_trabajo" label="Dirección de Trabajo" fgroup-class="mb-3" placeholder="Ingrese dirección del trabajo" />
                            <x-adminlte-input name="patrono_negocio" label="Nombre del Patrono o Negocio" fgroup-class="mb-3" placeholder="Ingrese Patrono o Negocio" required />
                            <x-adminlte-input name="tiempo_laborar" label="Tiempo de Laborar" fgroup-class="mb-3" placeholder="Ej. 2 años" required />
                            <x-adminlte-input name="gastos_alimentacion" label="Gastos de Alimentación" fgroup-class="mb-3" placeholder="Ingrese gastos" type="number" step="0.01" />

                            <x-adminlte-select name="estado_credito" label="Estado del Crédito" fgroup-class="mb-3" required>
                                <option value="">Seleccione...</option>
                                <option value="Aprobado">Aprobado</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Rechazado">Rechazado</option>
                            </x-adminlte-select>

                            <x-adminlte-input name="valor_cuota" label="Valor de la Cuota" fgroup-class="mb-3" placeholder="Ingrese el valor de la cuota" type="number" step="0.01" required />

                        </div>
                    </div>
                    <div class="modal-footer">
                        <x-adminlte-button label="Cancelar" data-bs-dismiss="modal" class="btn-secondary" />
                        <x-adminlte-button class="btn-flat" type="submit" label="Guardar Información Laboral" theme="success" icon="fas fa-lg fa-save" />
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
            $('#InformacionLaboralTable').DataTable({ // Inicializa DataTables en tu tabla "InformacionLaboralTable"
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

        function viewModal(informacionlaboral) {
            var modalBody = document.getElementById('viewModalBody');
            modalBody.innerHTML = `
        <div class="col-md-6">
            <p><strong>ID parametro:</strong> ${informacionlaboral.id_informacion_laboral}</p>
            <p><strong>tipo usuario:</strong> ${informacionlaboral.id_persona}</p>
            <p><strong>Clave :</strong> ${informacionlaboral.profesion_oficio}</p>
            <p><strong>Nombre Usuario:</strong> ${informacionlaboral.actividad}</p>
            <p><strong>Creado en:</strong> ${informacionlaboral.patrono_negocio}</p>
            <p><strong>Actualizado en:</strong> ${informacionlaboral.tiempo_laboral}</p>
            <p><strong>Intento ingreso:</strong> ${informacionlaboral.estado_credito}</p>
            <p><strong>Vencimiento usuario:</strong> ${informacionlaboral.valor_cuota}</p>
           
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

@section('css')
    <style>
        #InformacionLaboralTable_wrapper {
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



 
    