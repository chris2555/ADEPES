@extends('adminlte::page')

@section('title', 'Solicitud')
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
            <h4 class="mb-0"><i class="fas fa-file-contract"></i> Gestión de Solicitud</h4>

        </div>

        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert">
                <i class="fas fa-plus"></i> Nueva Solicitud
            </button>
        </div>

        <div class="d-flex justify-content-end">
            <div class="table-responsive ms-auto">
                <table id="relacionTable">
                    <thead>
                        <tr>
                            <th>ID Solicitud</th>
                            <th>Garantia</th>
                            <th>Cuota</th>
                            <th>Tasa</th>
                            <th>Plazo</th>
                            <th>Monto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($solicitudes as $solicitud)
                        <tr>
                            <td>{{ $solicitud['id_solicitud'] }}</td>
                            <td>{{ $solicitud['tipo_garantia'] }}</td>
                            <td>{{ $solicitud['tipo_cuota'] }}</td>
                            <td>{{ $solicitud['tasa'] }}</td>
                            <td>{{ $solicitud['plazo'] }}</td>
                            <td>{{ $solicitud['monto'] }}</td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-success btn-sm"
                                    onclick="viewModal({{ json_encode($solicitud) }})">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('solicitudes.show', $solicitud['id_solicitud']) }}"
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('solicitudes.destroy', $solicitud['id_solicitud']) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-warning btn-sm"
                                        onclick="return confirm('¿Está seguro de eliminar esta solicitud?')">
                                        <i class="fas fa-trash"></i> Eliminar
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
                <h5 class="modal-title" id="insertModalLabel">Insertar Nueva Solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="insertForm" action="{{ route('solicitudes.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">

                            <x-adminlte-select name="tipo_garantia" label="Seleccionar Tipo de Garantía" fgroup-class="mb-3" required>
                                <option value="">Seleccione una garantía</option>
                                <option value="Fiduciaria">Fiduciaria</option>
                                <option value="Prendaria">Prendaria</option>
                                <option value="Hipotecaria">Hipotecaria</option>
                                <option value="Solidaria">Solidaria</option>
                            </x-adminlte-select>

                            <x-adminlte-select name="tipo_cuota" label="Seleccionar Tipo de Cuota" fgroup-class="mb-3" required>
                                <option value="">Seleccione una Cuota</option>
                                <option value="Nivelada">Nivelada</option>
                                <option value="Variable">Variable</option>

                            </x-adminlte-select>

                            <x-adminlte-select name="tasa" label="Seleccionar Tasa de Interés" fgroup-class="mb-3" required>
                                <option value="">Seleccione una tasa</option>
                                @for ($tasa = 1.00; $tasa <= 10.00; $tasa +=0.5)
                                    <option value="{{ number_format($tasa, 2) }}">{{ number_format($tasa, 2) }}%</option>
                                    @endfor
                            </x-adminlte-select>

                            <x-adminlte-select name="plazo" label="Seleccionar Plazo (Meses)" fgroup-class="mb-3" required>
                                <option value="">Seleccione un plazo</option>
                                @for ($plazo = 6; $plazo <= 60; $plazo +=6)
                                    <option value="{{ $plazo }}">{{ $plazo }} meses</option>
                                    @endfor
                            </x-adminlte-select>

                            <x-adminlte-input name="monto" type="number" label="Monto del Préstamo"
                                placeholder="Ingrese el monto" fgroup-class="mb-3" step="0.01" min="1000" max="100000" required />

                        </div>
                        <div class="col-md-6">
                            <x-adminlte-select name="invierte_en" label="Sector de Inversión" fgroup-class="mb-3" required>
                                <option value="">Seleccione un sector</option>
                                <option value="Comercio">Comercio</option>
                                <option value="Industria">Industria</option>
                                <option value="Servicios">Servicios</option>
                                <option value="Agropecuario">Agropecuario</option>
                            </x-adminlte-select>

                            <x-adminlte-select name="tipo_credito" label="Tipo de Crédito" fgroup-class="mb-3" required>
                                <option value="">Seleccione un tipo de crédito</option>
                                <option value="Reingreso">Reingreso</option>
                                <option value="Refinanciamiento">Refinanciamiento</option>
                                <option value="Novacion">Novación</option>
                                <option value="Primera Vez">Primera Vez</option>
                            </x-adminlte-select>

                            <x-adminlte-select name="estado_solicitud" label="Estado de la Solicitud" fgroup-class="mb-3">
                                <option value="">Seleccione el estado</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Aprobado">Aprobado</option>
                                <option value="Rechazado">Rechazado</option>
                            </x-adminlte-select>

                            <x-adminlte-input name="valor_cuota" type="number" label="Valor de la Cuota"
                                placeholder="Ingresa el valor de la cuota" fgroup-class="mb-3" step="0.01" min="0" required />

                            <x-adminlte-select name="es_aval" label="Tipo de Aval" fgroup-class="mb-3" required>
                                <option value="">Seleccione el tipo de aval</option>
                                <option value="No es aval">No es aval</option>
                                <option value="Avala 1 persona">Avala 1 persona</option>
                                <option value="Avala 2 personas">Avala 2 personas</option>
                                <option value="Avala mas de 2 personas">Avala más de 2 personas</option>
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

{{-- Modal para Editar Solicitud --}}
<x-adminlte-modal id="edit" size="lg" title="Modificar Relación de Solicitud">
    <form id="updateForm">
        <div class="row">
            <x-adminlte-input name="UPDATE_PI_COD_SUCURSAL" id="cod" readonly label="Codigo de la Sucursal"
                placeholder="Ingresa el Codigo de la Sucursal" fgroup-class="col-md-6" />

            <x-adminlte-input name="UPDATE_PV_NOM_SUCURSAL" label="Nombre de la Sucursal"
                placeholder="Ingresa el Nombre de la Sucursal" fgroup-class="col-md-6" />

            <x-adminlte-input name="UPDATE_PI_COD_GERENTE" type="number" label="Codigo de Gerente"
                placeholder="Ingresa el Codigo del Gerente" fgroup-class="col-md-6" />

            <x-adminlte-input name="UPDATE_PI_COD_UBICACION" type="number" label="Codigo de Ubicacion"
                placeholder="Ingresa el codigo de la ubicacion" fgroup-class="col-md-6" />
        </div>
        <x-adminlte-button class="btn-flat" type="submit" label="Guardar Cambios" theme="success"
            icon="fas fa-lg fa-save" />
    </form>
</x-adminlte-modal>


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
            <p><strong>id del Solicitante:</strong> ${solicitud.id_solicitud}</p>
            <p><strong>Tipo Garantia:</strong> ${solicitud.tipo_garantia || 'No disponible'}</p>
            <p><strong>Tipo de cuota:</strong> ${solicitud.tipo_cuota}</p>
            <p><strong>Tasa:</strong> ${solicitud.tasa}</p>
            <p><strong>Plazo:</strong> ${solicitud.plazo || 'No disponible'}</p>
            <p><strong>Monto:</strong> ${solicitud.monto || 'No disponible'}</p>
             <p><strong>Estado de la Solicitud:</strong> ${solicitud.estado_solicitud || 'No disponible'}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Valor de la Cuota:</strong> ${solicitud.valor_cuota || 'No disponible'}</p>
             <p><strong>Es Aval:</strong> ${solicitud.es_aval || 'No disponible'}</p>
            <p><strong>Creado por:</strong> ${solicitud.creado_por}</p>
            <p><strong>Creado en:</strong> ${solicitud.creado_en ? new Date(solicitud.creado_en).toLocaleString() : 'No disponible'}</p>
            <p><strong>Modificado por:</strong> ${solicitud.modificado_por || 'No disponible'}</p>
            <p><strong>Modificado en:</strong> ${solicitud.modificado_en ? new Date(solicitud.modificado_en).toLocaleString() : 'No disponible'}</p>
        </div>
    `;

        var viewModalElement = new bootstrap.Modal(document.getElementById('view'));
        viewModalElement.show();
    }
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