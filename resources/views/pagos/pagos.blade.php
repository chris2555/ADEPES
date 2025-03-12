
@extends('layout.app')


@section('subtitle', 'Pagos')

@section('content_body')
@php
    use Carbon\Carbon;
@endphp
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
            <h4 class="mb-0"><i class="fas fa-file-contract"></i> Pagos</h4>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert">
                <i class="fas fa-plus"></i> Agregar Pago
            </button>
        </div>

        <div class="d-flex justify-content-end">
            <div class="table-responsive ms-auto">
                <table id="relacionTable">
                    <thead>
                        <tr>
                            <th>Fecha De Pago</th>
                            <th>No. de Cuota</th>
                            <th>Nombre Completo</th>
                            <th>Cuota Amortización</th>
                            <th>Pago Capital</th>
                            <th>Intereses Pagados</th>
                            <th>Abono</th>
                            <th>Diferencia de Pago</th>
                            <th>Estado de Pago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
    @php
        // Convertir $pagos en una colección
        $pagosCollection = collect($pagos);

        // Obtener el nombre filtrado desde el request
        $nombreFiltrado = request()->query('Nombre_Completo');

        // Filtrar pagos si se ingresó un nombre, ignorando mayúsculas y espacios
        $pagosFiltrados = $nombreFiltrado 
            ? $pagosCollection->filter(function ($pago) use ($nombreFiltrado) {
                return trim(strtolower($pago['Nombre_Completo'])) == trim(strtolower($nombreFiltrado));
            })->values() // <-- Aquí se restablecen las claves para evitar problemas con sum()
            : $pagosCollection;

        // Inicializar los totales con los valores filtrados
        $totalCuota = $pagosFiltrados->sum('Cuota_Amortizacion');
        $totalCapital = $pagosFiltrados->sum('Pago_Capital');
        $totalIntereses = $pagosFiltrados->sum('Intereses_Pagados');
        $totalAbono = $pagosFiltrados->sum('Abono');
        $totalDiferencia = $pagosFiltrados->sum('Diferencia_de_Pago');
    @endphp

    @foreach ($pagosFiltrados as $pago)
        <tr>
            <td>{{ \Carbon\Carbon::parse($pago['Fecha_De_Pago'])->translatedFormat('d \d\e F \d\e Y') }}</td>
            <td>{{ $pago['Numero_de_Cuota'] }}</td>
            <td>{{ $pago['Nombre_Completo'] }}</td>
            <td>{{ number_format($pago['Cuota_Amortizacion'], 2) }}</td>
            <td>{{ number_format($pago['Pago_Capital'], 2) }}</td>
            <td>{{ number_format($pago['Intereses_Pagados'], 2) }}</td>
            <td>{{ number_format($pago['Abono'], 2) }}</td>
            <td>{{ number_format($pago['Diferencia_de_Pago'], 2) }}</td>
            <td>{{ $pago['Estado_de_Pago'] }}</td>
            <td>
                <a href="javascript:void(0);" class="btn btn-success btn-sm" onclick="viewModal({{ json_encode($pago) }})">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="{{ route('pagos.show', $pago['ID_Pago']) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
                <form action="{{ route('pagos.destroy', $pago['ID_Pago']) }}" method="POST" class="d-inline delete-form">
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

@if ($pagosFiltrados->isNotEmpty()) 
    <tfoot>
        <tr>
            <td colspan="3" class="text-end fw-bold">
                Total de {{ $nombreFiltrado ?? 'todos' }}:
            </td>
            <td>{{ number_format($totalCuota, 2) }}</td>
            <td>{{ number_format($totalCapital, 2) }}</td>
            <td>{{ number_format($totalIntereses, 2) }}</td>
            <td>{{ number_format($totalAbono, 2) }}</td>
            <td>{{ number_format($totalDiferencia, 2) }}</td>
            <td colspan="2"></td>
        </tr>
    </tfoot>
@endif

    
                </table>
            </div>
        </div>
    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/luxon/3.4.3/luxon.min.js"></script>

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

        function viewModal(pagos) {
            var DateTime = luxon.DateTime;
            var fechaFormateada = DateTime.fromISO(pagos.Fecha_De_Pago, { zone: 'utc' }) // Forzar UTC si viene en Zulu time (Z)
            .setLocale('es') 
            .toFormat("dd 'de' MMMM 'de' yyyy");

            var modalBody = document.getElementById('viewModalBody');
            modalBody.innerHTML = `
        <div class="col-md-6">
            <p><strong>Fecha de Pago:</strong> ${fechaFormateada}</p>
            <p><strong>Metodo de Pago:</strong> ${pagos.Metodo_de_Pago || 'No disponible'}</p>
            <p><strong>Recibo:</strong> ${pagos.Recibo}</p>
            <p><strong>Estado de Pago:</strong> ${pagos.egresos}</p>
            <p><strong>Aval 1:</strong> ${pagos.nombre_aval1 || 'No disponible'}</p>
            <p><strong>Aval 2:</strong> ${pagos.nombre_aval2 || 'No disponible'}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Aval 3:</strong> ${pagos.nombre_aval3 || 'No disponible'}</p>
            <p><strong>Creado por:</strong> ${pagos.creado_por}</p>
            <p><strong>Creado en:</strong> ${pagos.creado_en ? new Date(pagos.creado_en).toLocaleString() : 'No disponible'}</p>
            <p><strong>Modificado por:</strong> ${pagos.modificado_por || 'No disponible'}</p>
            <p><strong>Modificado en:</strong> ${pagos.modificado_en ? new Date(pagos.modificado_en).toLocaleString() : 'No disponible'}</p>
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
    /* Contenedor de la tabla */
    #relacionTable_wrapper {
        margin-left: auto;
        width: 96%; /* Ajusta este valor según lo que necesites */
    }

    /* Contenedor principal ajustado */
    .container-fluid {
        width: 100vw;
        height: 100vh;
        padding: 0px;
        overflow-x: hidden; /* Evita desplazamiento horizontal innecesario */
    }

    /* Botones de exportación */
    .dt-buttons .btn {
        color: #fff !important;
        background-color: #28a745 !important; /* Verde */
        border: none !important;
        margin: 5px;
        font-size: 14px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .dt-buttons .btn:hover {
        filter: brightness(90%);
    }

    /* Tarjetas con mejor diseño */
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Tabla con mejor visibilidad */
    .table {
        font-size: 20px;
        width: 100%;
        border-collapse: collapse;
    }

    /* Botones pequeños */
    .btn-sm {
        border-radius: 5px;
        padding: 5px 10px;
    }

    /* Responsividad de la tabla */
    .table-responsive {
        overflow-x: auto;
    }
</style>




@stop











@stop

