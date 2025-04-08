
@extends('layout.app')


@section('subtitle', 'Pagos')

@section('content_body')

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
                <h4 class="mb-0"><i class="fas fa-file-invoice-dollar"></i> Gestión de Pagos</h4>
            </div>
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertPago">
                    <i class="fas fa-plus"></i> Nuevo Pago
                </button>
            </div>
            <div class="d-flex justify-content-end">
                <div class="table-responsive table-hover table-striped table-sm">
                    <table id="pagoTable">
                    <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Nombre Cliente</th>
                                    <th>Monto Préstamo</th>
                                    <th>Monto</th>
                                    <th>Intereses</th>
                                    <th>Abono a Capital</th>
                                    <th>Excedente/Déficit</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pagos as $pago)
                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($pago['fecha'])) }}</td>
                                        <td>{{ $pago['nombres_apellidos'] }}</td>
                                        <td>{{ $pago['monto_prestamo'] }}</td>
                                        <td>{{ $pago['monto'] }}</td>
                                        <td>{{ $pago['intereses'] }}</td>
                                        <td>{{ $pago['abono_capital'] }}</td>
                                        <td>{{ $pago['estado'] }}</td>
                                        
                                        <td>
                                        <a href="javascript:void(0);" class="btn btn-outline-success btn-sm"
                                            onclick="viewModal({{ json_encode($pago) }})">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('pagos.show', $pago['id_pago']) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('pagado', $pago['id_persona']) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-money-bill-wave"></i>
                                        </a>
                                        
                                        <form action="{{ route('pagos.destroy', $pago['id_pago']) }}" method="POST" class="d-inline delete-form">
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
    
    
<!-- Modal para Insertar Nuevo Pago -->
<div class="modal fade" id="insertPago" tabindex="-1" aria-labelledby="insertPagoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertPagoLabel">Agregar Nuevo Pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pagos.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                           
                            <x-adminlte-select name="id_prestamo" label="Seleccionar Préstamo" fgroup-class="mb-3" required>
                                <option value="">Seleccione un préstamo</option>
                                @foreach ($prestamos as $prestamo)
                                    <option value="{{ $prestamo['id_prestamo'] }}">
                                        {{ $prestamo['id_prestamo'] }} - {{ $prestamo['nombres_apellidos'] }} - L.{{ number_format($prestamo['monto'], 2) }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                            
                            
                            <x-adminlte-select name="id_persona" label="Seleccionar Persona" fgroup-class="mb-3" required>
                                <option value="">Seleccione una persona</option>
                                @foreach ($personas as $persona)
                                    <option value="{{ $persona->id_persona }}">
                                        {{ $persona->nombres_apellidos }} - {{ $persona->n_identidad }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                            
                            <x-adminlte-input name="monto" label="Monto del Pago" type="number" step="0.01" min="0" fgroup-class="mb-3" placeholder="Ingrese el monto" required />

                            <x-adminlte-select name="metodo_pago" label="Método de Pago" fgroup-class="mb-3" required>
                                <option value="">Seleccione...</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Cheque">Cheque</option>
                            </x-adminlte-select>

                            <x-adminlte-input name="recibo" label="Número de Recibo" type="text" fgroup-class="mb-3" placeholder="Ingrese el número de recibo"  />
                        </div>

                        <div class="col-md-6">
                        <x-adminlte-input name="fecha" label="Fecha de Pago" type="date" fgroup-class="mb-3" required />


                            <x-adminlte-input name="intereses" label="Intereses" type="number" step="0.01" min="0" fgroup-class="mb-3" placeholder="Ingrese el monto de intereses"  required />
                            <x-adminlte-input name="abono_capital" label="Abono Capital" type="number" fgroup-class="mb-3" readonly /> 
                        </div>
                    </div>

                    <div class="modal-footer">
                        <x-adminlte-button label="Cancelar" data-bs-dismiss="modal" class="btn-secondary" />
                        <x-adminlte-button class="btn-flat" type="submit" label="Guardar Pago" theme="success" icon="fas fa-lg fa-save" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



    {{-- Modal para Ver Información de pagos --}}
    <div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Información del Pago</h5>
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

    @section('js')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Campos relevantes
        const montoField = document.querySelector('input[name="monto"]');
        const interesesField = document.querySelector('input[name="intereses"]');
        const abonoCapitalField = document.querySelector('input[name="abono_capital"]');

        function calculateAbonoCapital() {
            // Convertir valores a números y validar
            const monto = parseFloat(montoField.value) || 0; // Monto del pago
            const intereses = parseFloat(interesesField.value) || 0; // Intereses

            // Calcular abono capital
            const abonoCapital = monto - intereses;

            // Mostrar resultado (asegurarse de que no sea negativo)
            abonoCapitalField.value = abonoCapital > 0 ? abonoCapital.toFixed(2) : 0.00;
        }

        // Escuchar cambios en los campos monto e intereses
        [montoField, interesesField].forEach(field => {
            field.addEventListener('input', calculateAbonoCapital);
        });

        // Ejecutar cálculo inicial si hay valores preestablecidos
        calculateAbonoCapital();
    });
</script>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/luxon/3.4.3/luxon.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#pagoTable').DataTable({ // Inicializa DataTables en tu tabla "relacionTable"
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

        function viewModal(pagos) {
    var DateTime = luxon.DateTime;
    var fechaFormateada = DateTime.fromISO(pagos.fecha, { zone: 'utc' }) // Formato de fecha
        .setLocale('es')
        .toFormat("dd 'de' MMMM 'de' yyyy");

    var modalBody = document.getElementById('viewModalBody');
    modalBody.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <p><strong>ID Pago:</strong> ${pagos.id_pago}</p>
                <p><strong>ID Préstamo:</strong> ${pagos.id_prestamo}</p>
                <p><strong>Monto del Préstamo:</strong> ${pagos.monto_prestamo}</p>
                <p><strong>ID Persona:</strong> ${pagos.id_persona}</p>
                <p><strong>Nombre del Cliente:</strong> ${pagos.nombres_apellidos}</p>
                <p><strong>Método de Pago:</strong> ${pagos.metodo_pago}</p>
                <p><strong>Recibo:</strong> ${pagos.recibo}</p>
                <p><strong>Monto Pagado:</strong> ${pagos.monto}</p>
                <p><strong>Fecha de Pago:</strong> ${fechaFormateada}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Intereses:</strong> ${pagos.intereses}</p>
                <p><strong>Creado por:</strong> ${pagos.creado_por}</p>
                <p><strong>Creado en:</strong> ${pagos.creado_en ? new Date(pagos.creado_en).toLocaleString() : 'No disponible'}</p>
                <p><strong>Modificado por:</strong> ${pagos.modificado_por || 'No disponible'}</p>
                <p><strong>Modificado en:</strong> ${pagos.modificado_en ? new Date(pagos.modificado_en).toLocaleString() : 'No disponible'}</p>
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

@section('css')
<style>
    #pagoTable_wrapper {
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

