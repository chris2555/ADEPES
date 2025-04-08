@extends('adminlte::page')

@section('title', 'Gestión de Pagos')

@section('content_header')
<h1><b>Listado de Pagos</b></h1>
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
            <h3 class="card-title">Gestion de pagos</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertPago">
                <i class="fas fa-plus"></i> Nuevo Pago
            </button>
            </div>
            </div>


            <div class="card-body">
            <div class="table-responsive">
                    <table id="pagoTable" class="table table-bordered table-hover table-striped table-sm">
                        <thead class="text-center">
                            <tr>
                                <th style="text-align: center" data-order="asc">ID Pago</th>
                                <th>ID Préstamo</th>
                                <th>Monto Préstamo</th>
                                <th>Nombre Cliente</th>
                                <th>Método de Pago</th>
                                <th>Recibo</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(collect($pagos)->sortBy(fn($p) => (int) $p['id_pago']) as $pago)
                                <tr class="text-center align-middle">
                                    <td>{{ $pago['id_pago'] }}</td>
                                    <td>{{ $pago['id_prestamo'] }}</td>
                                    <td>{{ $pago['monto_prestamo'] }}</td>
                                    <td>{{ $pago['nombres_apellidos'] }}</td>
                                    <td>{{ $pago['metodo_pago'] }}</td>
                                    <td>{{ $pago['recibo'] }}</td>
                                    <td>{{ $pago['monto'] }}</td>
                                    <td>{{ date('d-m-Y', strtotime($pago['fecha'])) }}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" 
                                        onclick="viewModal({{ json_encode($pago) }})">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('pagos.show', $pago['id_pago']) }}" 
                                        class="btn btn-sm btn-success">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ route('pagado', $pago['id_persona']) }}" 
                                        class="btn btn-sm btn-info">
                                            <i class="fa fa-money-bill-wave"></i>
                                        </a>
                                        <form action="{{ route('pagos.destroy', $pago['id_pago']) }}" 
                                        method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger delete-btn">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script>
function sortTable(columnIndex) {
    let table = document.getElementById("pagoTable");
    let rows = Array.from(table.rows).slice(1); // Omitimos el encabezado
    let sortedRows = rows.sort((a, b) => {
        return a.cells[columnIndex].innerText - b.cells[columnIndex].innerText;
    });

    </script>
                </div>

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
                        </div>

<!-- Modal para Insertar Nuevo Pago -->
<div class="modal fade" id="insertPago" tabindex="-1" aria-labelledby="insertPagoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel">Agregar Nuevo Pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                 <form id="insertForm" action="{{ route('pagos.store') }}" method="POST">
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


                            <x-adminlte-input name="intereses" label="Intereses" type="number" step="0.01" min="0" fgroup-class="mb-3" placeholder="Ingrese el monto de intereses" value="0" />

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

@stop

    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/luxon@3.4.4/build/global/luxon.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

    $(function () {
        $('#pagoTable').DataTable({ // Inicializa DataTables en tu tabla "relacionTable"
            "order": [[0, "asc"]],
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
                    { text: '<i class="fas fa-copy"></i> COPIAR', extend: 'copy', className: 'btn btn-success' },
                    { text: '<i class="fas fa-file-csv"></i> CSV', extend: 'csv', className: 'btn btn-success' },
                    { text: '<i class="fas fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-success' },
                    { text: '<i class="fas fa-file-pdf"></i> PDF', extend: 'pdf', className: 'btn btn-success' },
                    { text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-success' },
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
    // Selecciona todos los botones de eliminación
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault(); // Evita la eliminación inmediata
            let form = this.closest("form"); // Encuentra el formulario más cercano
            
            Swal.fire({
                title: "¿Está seguro?",
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Envía el formulario solo si el usuario confirma
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