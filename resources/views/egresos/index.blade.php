@extends('adminlte::page')

@section('title', 'Egresos')
@section('plugins.Sweetalert2', true)

@section('content_header')

@stop

@section('content')

    <head>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>

    <div class="container-fluid mt-4">
        <div class="shadow-lg p-5 bg-white">
            <div class="card-header text-success text-center">
                <h4 class="mb-0"><i class="fas fa-file-contract"></i> Egresos</h4>

            </div>

            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertEgreso">
                    <i class="fas fa-plus"></i> Nueva egreso
                </button>
            </div>

            <div class="d-flex justify-content-end">
            <div class="table-responsive table-hover table-striped table-sm">
                    <table id="egresoTable">
                        <thead>
                            <tr>
                                <th>ID egreso</th>
                                <th>ID solicitud</th>
                                <th>central de riesgo</th>
                                <th>Otros egresos</th>
                                <th>Total egresos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Estadoegresos as $Estadoegreso)
                                <tr>
                                    <td>{{ $Estadoegreso['id_egresos'] }}</td>
                                    <td>{{ $Estadoegreso['id_solicitud'] }}</td>
                                    <td>{{ $Estadoegreso['central_riesgo'] }}</td>
                                    <td>{{ $Estadoegreso['otro_egresos'] ?? 'N/A' }}</td>
                                    <td>{{ $Estadoegreso['total_egresos'] ?? 'N/A' }}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-outline-success btn-sm"
                                            onclick="viewModal({{ json_encode($Estadoegreso) }})">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('egresos.show', $Estadoegreso['id_egresos'])}}" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('egresos.destroy', $Estadoegreso['id_egresos']) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger btn-sm delete-btn">
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



    <!-- Modal para Insertar Nuevo Egreso -->
<div class="modal fade" id="insertEgreso" tabindex="-1" aria-labelledby="insertEgresoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertEgresoLabel">Agregar Nuevo Egreso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="insertEgresoForm" action="{{ route('egresos.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-select name="id_persona" label="Seleccionar Persona" fgroup-class="mb-3" required>
                                <option value="">Seleccione una persona</option>
                                @foreach ($personas as $persona)
                                    <option value="{{ $persona->id_persona }}">
                                        {{ $persona->nombres_apellidos }} - {{ $persona->n_identidad }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>

                            <x-adminlte-select name="id_solicitud" label="Seleccionar solicitud" fgroup-class="mb-3" required>
                                <option value="">Seleccione una solicitud</option>
                                @foreach ($solicitudes as $solicitud)
                                    <option value="{{ $persona->id_persona }}">
                                        {{ $solicitud->id_solicitud }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>

                            <x-adminlte-input name="central_riesgo" label="Central de Riesgo" type="text" fgroup-class="mb-3" placeholder="Ingrese estado de central de riesgo" required />

                            <x-adminlte-input name="otro_egresos" label="Otros Egresos" type="number" step="0.01" fgroup-class="mb-3" placeholder="Ingrese otros egresos" required />
                        </div>
                        
                        <div class="col-md-6">
                            <x-adminlte-input name="total_egresos" label="Total de Egresos" type="number" step="0.01" fgroup-class="mb-3" placeholder="Ingrese el total de egresos" required />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <x-adminlte-button label="Cancelar" data-bs-dismiss="modal" class="btn-secondary" />
                        <x-adminlte-button class="btn-flat" type="submit" label="Guardar Egreso" theme="success" icon="fas fa-lg fa-save" />
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
            $('#viviendaTable').DataTable({ // Inicializa DataTables en tu tabla "relacionTable"
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

        function viewModal(vivienda) {
    var modalBody = document.getElementById('viewModalBody');
    modalBody.innerHTML = `
        <div class="col-md-6">
            <p><strong>Nombre del Solicitante:</strong> ${vivienda.nombre_persona}</p>
            <p><strong>Dependientes:</strong> ${vivienda.dependiente || 'No disponible'}</p>
            <p><strong>Tipo de Casa:</strong> ${vivienda.tipo_casa}</p>
            <p><strong>Tiempo Viviendo:</strong> ${vivienda.tiempo_vivir}</p>
            <p><strong>Pago de Vivienda:</strong> ${vivienda.pago_vivienda || 'No disponible'}</p>
             <p><strong>Tipo de Pago:</strong> ${vivienda.tipo_pago_vivienda || 'No disponible'}</p>
            <p><strong>Valor del Pago:</strong> ${vivienda.valor_pago ? vivienda.valor_pago + ' Lps' : 'No disponible'}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Dirección Completa:</strong> ${vivienda.direccion_completa || 'No disponible'}</p>
            <p><strong>Material de Construcción:</strong> ${vivienda.material_construccion}</p>
            <p><strong>Creado por:</strong> ${vivienda.creado_por}</p>
            <p><strong>Creado en:</strong> ${vivienda.creado_en ? new Date(vivienda.creado_en).toLocaleString() : 'No disponible'}</p>
            <p><strong>Modificado por:</strong> ${vivienda.modificado_por || 'No disponible'}</p>
            <p><strong>Modificado en:</strong> ${vivienda.modificado_en ? new Date(vivienda.modificado_en).toLocaleString() : 'No disponible'}</p>
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
