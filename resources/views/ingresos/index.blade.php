@extends('adminlte::page')

@section('title', 'Estado de Ingresos')

@section('content_header')
<h1><b>Listado de Ingreso y Egresos</b></h1>
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
            <h3 class="card-title">Estado de Ingresos</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert">
                    <i class="fas fa-plus"></i> Nuevo Estado de Ingreso y Egreso
                </button>
                </div>
                </div>

            <div class="card-body">
            <div class="table-responsive">
                    <table id="relacionTable" class="table table-bordered table-hover table-striped table-sm">
                        <thead>
                            <tr>
                                <th style="text-align: center" data-order="asc">ID Ingresos</th>
                                <th style="text-align: center">Solicitante</th>
                                <th style="text-align: center">Total Ingresos</th>
                                <th style="text-align: center">total_egresos</th>
                                <th style="text-align: center">ingreso_neto</th>
                                <th style="text-align: center">Acciones</th>
                                <th style="text-align: center">Dictamen</th>
                                </tr>
                    </thead>
                    <tbody>
                     @foreach(collect($ingresos)->sortBy(fn($p) => (int) $p['id_ingresos']) as $ingreso)
                                <tr>
                                    <td style="text-align: center" data-order="asc">{{ $ingreso['id_ingresos'] }}</td>
                                    <td>{{ $ingreso['nombres_persona'] }}</td>
                                    <td>{{ $ingreso['total_ingresos'] }}</td>
                                    <td>{{ $ingreso['total_egresos'] }}</td>
                                    <td>{{ $ingreso['ingreso_neto'] }}</td>
                                    <td style="text-align: center">
                                        <a href="javascript:void(0);" class="btn btn-success btn-sm"
                                            onclick="viewModal({{ json_encode($ingreso) }})">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('ingresos.show', $ingreso['id_ingresos'])}}" 
                                        class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('ingresos.destroy', $ingreso['id_ingresos']) }}" 
                                        method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                            <i class="bi bi-trash"></i>
                                    </button>
                                            </form>
            </td>
            <td style="text-align: center">
    @if ($ingreso['ingreso_neto'] >= 0)
        <span class="badge bg-success p-2">Favorable</span>
    @else
        <span class="badge bg-danger p-2">Desfavorable</span>
    @endif
    </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    <script>
function sortTable(columnIndex) {
    let table = document.getElementById("relacionTable");
    let rows = Array.from(table.rows).slice(1); // Omitimos el encabezado
    let sortedRows = rows.sort((a, b) => {
        return a.cells[columnIndex].innerText - b.cells[columnIndex].innerText;
    });

    </script>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Información Estado de Ingreso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="viewModalBody">
                        {{-- El contenido del modal se carga aquí con JavaScript --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div>


    {{-- Modal para Insertar Nuevo Estado de Pago --}}
<div class="modal fade" id="insert" tabindex="-1" aria-labelledby="insertIngresoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertIngresoLabel">Agregar Nuevo Estado de Ingreso y Egreso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="insertIngresoForm" action="{{ route('ingresos.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                        <x-adminlte-select name="id_persona" label="Seleccionar Persona" fgroup-class="mb-3" required>
                                <option value="">Seleccione Una Persona</option>
                                @foreach ($personas as $persona)
                                    <option value="{{ $persona->id_persona }}">
                                        {{ $persona->nombres_apellidos }} - {{ $persona->n_identidad }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                            
                            <x-adminlte-input name="sueldo_base" label="Sueldo Base" type="number" min="0" value="0" class="form-control income-field" fgroup-class="mb-3" required />
                            <x-adminlte-input name="remesas" label="Remesas" type="number" min="0" value="0" class="form-control income-field" fgroup-class="mb-3" required />
                            <x-adminlte-input name="ingresos_sociedad" label="Ingresos Sociedad" type="number" min="0" value="0" class="form-control income-field" fgroup-class="mb-3" required />
                            <x-adminlte-input name="renta_propiedades" label="Renta Propiedad" type="number" min="0" value="0" class="form-control income-field" fgroup-class="mb-3" required />
                            <x-adminlte-input name="aporte_conyuge" label="Aporte Cónyuge" type="number" min="0" value="0" class="form-control income-field" fgroup-class="mb-3" required />

                            <x-adminlte-input name="total_ingresos" label="Total Ingresos" type="number" fgroup-class="mb-3" readonly />                       
                        </div>

                        <div class="col-md-6">
                       
                        <x-adminlte-input name="cuota_de_prestamo" label="Cuota de Préstamo en ADEPES" type="number" min="0" value="0" class="form-control expense-field" fgroup-class="mb-3" required />
                        <x-adminlte-input name="cuota_vivienda" label="Cuota de Vivienda" type="number" min="0" value="0" class="form-control expense-field" fgroup-class="mb-3" required />
                        <x-adminlte-input name="alimentacion" label="Alimentación" type="number" min="0" value="0" class="form-control expense-field" fgroup-class="mb-3" required />
                        <x-adminlte-input name="central_riesgo" label="Central de riesgo como Cliente" type="number" min="0" value="0" class="form-control expense-field" fgroup-class="mb-3" required />
                        <x-adminlte-input name="otro_egresos" label="Otros Egresos" type="number" min="0" value="0" class="form-control expense-field" fgroup-class="mb-3" required />
                        <x-adminlte-input name="total_egresos" label="Total Egresos" type="number" fgroup-class="mb-3" readonly />
                        <x-adminlte-input name="total_ingresos_netos" label="Ingresos Netos" type="number" fgroup-class="mb-3 text-center" readonly />
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script>
        document.addEventListener('DOMContentLoaded', function () {
    const incomeFields = document.querySelectorAll('.income-field'); // Recolectar campos
    const totalField = document.querySelector('input[name="total_ingresos"]');

    function calculateTotal() {
        let total = 0;
        incomeFields.forEach(field => {
            let value = parseFloat(field.value);
            total += isNaN(value) ? 0 : value; // Asegurar que sea un número
        });
        totalField.value = total.toFixed(2); // Mostrar con 2 decimales
    }

    // Escuchar eventos de input para recalcular dinámicamente
    incomeFields.forEach(field => {
        field.addEventListener('input', calculateTotal);
    });

    // Ejecutar cálculo inicial si ya hay valores en los campos
    calculateTotal();
});
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const incomeFields = document.querySelectorAll(".income-field");
    const expenseFields = document.querySelectorAll(".expense-field");
    const totalIngresosField = document.querySelector('input[name="total_ingresos"]');
    const totalEgresosField = document.querySelector('input[name="total_egresos"]');
    const ingresosNetosField = document.querySelector('input[name="total_ingresos_netos"]');

    function calculateTotals() {
        let totalIngresos = 0;
        let totalEgresos = 0;

        incomeFields.forEach(field => totalIngresos += parseFloat(field.value) || 0);
        expenseFields.forEach(field => totalEgresos += parseFloat(field.value) || 0);

        totalIngresosField.value = totalIngresos.toFixed(2);
        totalEgresosField.value = totalEgresos.toFixed(2);
        ingresosNetosField.value = (totalIngresos - totalEgresos).toFixed(2);
    }

    incomeFields.forEach(field => field.addEventListener("input", calculateTotals));
    expenseFields.forEach(field => field.addEventListener("input", calculateTotals));
});
</script>
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
        $(document).ready(function() {
            $('#relacionTable').DataTable({ // Inicializa DataTables en tu tabla "relacionTable"
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

        function viewModal(ingreso) {
    var modalBody = document.getElementById('viewModalBody');
    modalBody.innerHTML = `
    <div class="row">
        <div class="col-md-4">
            <p><strong>ID Ingreso:</strong> ${ingreso.id_ingresos}</p>
            <p><strong>Nombre del Solicitante:</strong> ${ingreso.nombres_persona  || 'No disponible'}</p>
            <p><strong>Creado por:</strong> ${ingreso.creado_por_nombre || 'No disponible'}</p>
            <p><strong>Creado en:</strong> ${ingreso.creado_en ? new Date(ingreso.creado_en).toLocaleString() : 'No disponible'}</p>
            <p><strong>Modificado por:</strong> ${ingreso.modificado_por_nombre || 'No disponible'}</p>
            <p><strong>Modificado en:</strong> ${ingreso.modificado_en ? new Date(ingreso.modificado_en).toLocaleString() : 'No disponible'}</p>
        </div>
        <div class="col-md-4">
            <p><strong>Sueldo Base:</strong> ${ingreso.sueldo_base}</p>
            <p><strong>Rentapropiedad:</strong> ${ingreso.renta_propiedades}</p>
            <p><strong>Remesas:</strong> ${ingreso.remesas}</p>
            <p><strong>Aporte Conyugue:</strong> ${ingreso.aporte_conyuge}</p>
            <p><strong>Ingresos Sociedad:</strong> ${ingreso.ingresos_sociedad}</p>
            <p><strong>Total Ingresos:</strong> ${ingreso.total_ingresos}</p>
        </div>
        
         <div class="col-md-4">
            <p><strong>Cuota de Préstamo:</strong> ${ingreso.cuota_de_prestamo}</p>
            <p><strong>Cuota Vivienda:</strong> ${ingreso.cuota_vivienda}</p>
            <p><strong>Alimentación:</strong> ${ingreso.alimentacion}</p>
            <p><strong>Central de Riesgo:</strong> ${ingreso.central_riesgo}</p>
            <p><strong>Otros Egresos:</strong> ${ingreso.otro_egresos}</p>
            <p><strong>Total Egresos:</strong> ${ingreso.total_egresos}</p>
            <p><strong>Ingreso Neto:</strong> ${ingreso.ingreso_neto}</p>
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

