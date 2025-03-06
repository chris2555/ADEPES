@extends('adminlte::page')

@section('title', 'Gestion de Conyuge')
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
            <h4 class="mb-0"><i class="fas fa-file-contract"></i> Gestión de Conyuge</h4>

        </div>

        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert">
                <i class="fas fa-plus"></i> Nuevo Conyuge
            </button>
        </div>

        <div class="d-flex justify-content-end">
            <div class="table-responsive ms-auto">
                <table id="relacionTable">
                    <thead>
                        <tr>
                            <th>ID Conyuge</th>
                            <th>Nombre</th>
                            <th>Fecha Nacimiento</th>
                            <th>Identidad</th>
                            <th>Direccion</th>
                            <th>Profesion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($solicitudes as $solicitud)
                        <tr>
                            <td>{{ $solicitud['id_conyuge'] }}</td>
                            <td>{{ $solicitud['nombres_conyuge'] }}</td>
                            <td>{{ $solicitud['fecha_nacimiento_conyuge'] }}</td>
                            <td>{{ $solicitud['identidad_conyuge'] }}</td>
                            <td>{{ $solicitud['direccion_conyuge'] }}</td>
                            <td>{{ $solicitud['profesion_oficio_conyuge'] }}</td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-success btn-sm"
                                    onclick="viewModal({{ json_encode($solicitud) }})">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('conyuge.show', $solicitud['id_conyuge']) }}"
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('conyuge.destroy', $solicitud['id_conyuge']) }}"
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
                <h5 class="modal-title" id="viewModalLabel">Información del Conyuge</h5>
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
                <h5 class="modal-title" id="insertModalLabel">Insertar Nuevo conyuge</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="insertForm" action="{{ route('conyuge.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">

                            <x-adminlte-input name="nombres_conyuge" label="Nombre del Cónyuge" type="text" fgroup-class="mb-3" required
                                placeholder="Ingrese el nombre del cónyuge" />

                            <x-adminlte-input name="fecha_nacimiento_conyuge" label="Fecha de Nacimiento del Cónyuge" type="date" fgroup-class="mb-3" required />

                            <x-adminlte-input name="identidad_conyuge" label="Identidad del Cónyuge" type="text" fgroup-class="mb-3" required
                                placeholder="Ingrese la identidad del cónyuge" />

                            <x-adminlte-textarea name="direccion_conyuge" label="Dirección del Cónyuge" fgroup-class="mb-3" required
                                placeholder="Ingrese la dirección del cónyuge" />

                            <x-adminlte-input name="profesion_oficio_conyuge" label="Profesión u Oficio del Cónyuge" type="text" fgroup-class="mb-3" required
                                placeholder="Ingrese la profesión u oficio del cónyuge" />

                            <x-adminlte-input name="cargo_conyuge" label="Cargo del Cónyuge" type="text" fgroup-class="mb-3" required
                                placeholder="Ingrese el cargo del cónyuge" />


                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input name="ingresos_negocio_conyuge" label="Ingresos del Negocio del Cónyuge" type="number" fgroup-class="mb-3" required
                                placeholder="Ingrese los ingresos" step="0.01" min="0" />

                            <x-adminlte-textarea name="direccion_trabajo_conyuge" label="Dirección de Trabajo del Cónyuge" fgroup-class="mb-3" required
                                placeholder="Ingrese la dirección de trabajo del cónyuge" />

                            <x-adminlte-select name="tipo_cliente" label="Tipo de Cliente" fgroup-class="mb-3" required>
                                <option value="">Seleccione un tipo de cliente</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                                <option value="Primera vez">Primera vez</option>
                            </x-adminlte-select>

                            <x-adminlte-select name="tiempo_laborar_conyuge" label="Tiempo de Laborar del Cónyuge" fgroup-class="mb-3" required>
                                <option value="">Seleccione el tiempo</option>
                                <option value="1 año">1 año</option>
                                <option value="2 años">2 años</option>
                                <option value="3 años">3 años</option>
                                <option value="4 años">4 años</option>
                                <option value="Más de 5 años">Más de 5 años</option>
                            </x-adminlte-select>

                            <x-adminlte-input name="gastos_alimentacion_conyuge" label="Gastos de Alimentación del Cónyuge" type="number" fgroup-class="mb-3" required
                                placeholder="Ingrese los gastos de alimentación" step="0.01" min="0" />

                            <x-adminlte-input name="estado_credito_conyuge" label="Estado de Crédito del Cónyuge" type="text" fgroup-class="mb-3" required
                                placeholder="Ingrese el estado de crédito del cónyuge" />


                        </div>
                    </div>
                    <div class="modal-footer">
                        <x-adminlte-button label="Cancelar" data-bs-dismiss="modal" class="btn-secondary" />
                        <x-adminlte-button class="btn-flat" type="submit" id="btnGuardar" label="Guardar Informacion"
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
            <p><strong>id del conyuge:</strong> ${solicitud.id_conyuge}</p>
            <p><strong>Nombre del Conyuge:</strong> ${solicitud.nombres_conyuge  || 'No disponible'}</p>
            <p><strong>Fecha de Nacimiento:</strong> ${solicitud.fecha_nacimiento_conyuge }</p>
            <p><strong>Identidad:</strong> ${solicitud.identidad_conyuge }</p>
            <p><strong>Direccion:</strong> ${solicitud.direccion_conyuge  || 'No disponible'}</p>
            <p><strong>Profesion:</strong> ${solicitud.profesion_oficio_conyuge  || 'No disponible'}</p>
            <p><strong>Cargo:</strong> ${solicitud.cargo_conyuge  || 'No disponible'}</p>
            <p><strong>Ingresos del Negocio:</strong> ${solicitud.ingresos_negocio_conyuge  || 'No disponible'}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Direccion del trabajo:</strong> ${solicitud.direccion_trabajo_conyuge  || 'No disponible'}</p>
            <p><strong>Tipo de Cliente:</strong> ${solicitud.tipo_cliente   || 'No disponible'}</p>
            <p><strong>Tiempo de Laborar:</strong> ${solicitud.tiempo_laborar_conyuge   || 'No disponible'}</p>
            <p><strong>Gastos Alimenticios:</strong> ${solicitud.gastos_alimentacion_conyuge   || 'No disponible'}</p>
            <p><strong>Estado de Credito:</strong> ${solicitud.estado_credito_conyuge   || 'No disponible'}</p>
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