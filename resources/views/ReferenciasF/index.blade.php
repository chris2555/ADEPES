@extends('adminlte::page')

@section('Referencias Familiares', 'Gestión de Referencias Familiares')
@section('plugins.Sweetalert2', true)

@section('content_header')
<h1><b>Listado de Referencias Familiares</b></h1>
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
            <h3 class="card-title">DATOS REFERENCIAS FAMILIARES</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert">
                <i class="fas fa-plus"></i> Nueva Referencia Familiar
            </button>
            </div>
            </div>

            <div class="card-body">
            <div class="table-responsive">
            <table id="referenciasTable" class="table table-bordered table-hover table-striped table-sm">
                <thead>
                    <tr>
                        <th style="text-align: center" data-order="asc">ID</th>
                        <th style="text-align: center">ID Solicitud</th>
                        <th style="text-align: center">Nombre</th>
                        <th style="text-align: center">Parentesco</th>
                        <th style="text-align: center">Dirección</th>
                        <th style="text-align: center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                 @foreach ($referencias as $referencia)
                    <tr>
                        <td style="text-align: center" data-order="asc">{{ $referencia['id_referencia'] }}</td>
                        <td>{{ $referencia['id_solicitud'] }}</td>
                        <td>{{ $referencia['nombre_familiar'] }}</td>
                        <td>{{ $referencia['parentesco'] }}</td>
                        <td>{{ $referencia['direccion_familiar'] }}</td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-success btn-sm" 
                                onclick="viewModal({{ json_encode($referencia) }})">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('referencias.show', $referencia['id_referencia']) }}" 
                                class="btn btn-primary btn-sm">
                                 <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('referencias.destroy', $referencia['id_referencia']) }}" 
                                method="POST" class="d-inline ">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn">
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
    let table = document.getElementById("relacionTable");
    let rows = Array.from(table.rows).slice(1); // Omitimos el encabezado
    let sortedRows = rows.sort((a, b) => {
        return a.cells[columnIndex].innerText - b.cells[columnIndex].innerText;
    });

    </script>
        </div>
    </div>
</div>


<div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Información de Referencia</h5>
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

<!-- Modal para Insertar Nueva Referencia -->
<div class="modal fade" id="nuevareferencia" tabindex="-1" aria-labelledby="nuevareferenciaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevareferencia">Agregar Nueva Referencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="insertForm" action="{{ route('referencias.store') }}" method="POST">
                    @csrf

                    <!-- ID Solicitud -->
                    <x-adminlte-select name="id_solicitud" label="Seleccionar Solicitud" fgroup-class="mb-3" required>
                                <option value="">Seleccione una solicitud</option>
                                @foreach ($solicitudes as $solicitud)
                                    <option value="{{ $solicitud->id_solicitud }}">
                                        ID: {{ $solicitud->id_solicitud }} - Monto: {{ number_format($solicitud->monto, 2) }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                    <!-- Nombre del Familiar -->
                    <x-adminlte-input name="nombre_familiar" id="nombre_familiar" label="Nombre del Familiar" required fgroup-class="mb-3" />

                    <!-- Parentesco -->
                    <x-adminlte-input name="parentesco" id="parentesco" label="Parentesco"  required fgroup-class="mb-3" />

                    <!-- Dirección -->
                    <x-adminlte-textarea name="direccion_familiar" id="direccion_familiar" label="Dirección" required fgroup-class="mb-3" rows="3" />

                    <input type="hidden" name="creado_por" value="{{ auth()->user()->id }}">

                    <div class="modal-footer">
                        <x-adminlte-button label="Cancelar" data-bs-dismiss="modal" class="btn-secondary" />
                        <x-adminlte-button type="submit" label="Guardar Referencia" theme="success" icon="fas fa-save" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById("insertForm").addEventListener("submit", function(event) {
    // Obtener valores de los campos
    let idSolicitud = document.getElementById("id_solicitud").value.trim();
    let nombreFamiliar = document.getElementById("nombre_familiar").value.trim();
    let parentesco = document.getElementById("parentesco").value.trim();
    let direccionFamiliar = document.getElementById("direccion_familiar").value.trim();

    // Expresiones regulares
    let soloLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/; // Letras, acentos y espacios
    let letrasYNumeros = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s.,#-]+$/; // Letras, números y caracteres básicos

    // Validación ID Solicitud (debe ser mayor que 0)
    if (isNaN(idSolicitud) || idSolicitud < 1) {
        alert("Error: ID Solicitud debe ser un número mayor que 0.");
        event.preventDefault();
        return;
    }

    // Validación Nombre del Familiar (solo letras y espacios)
    if (!soloLetras.test(nombreFamiliar)) {
        alert("Error: Nombre del Familiar solo puede contener letras y espacios.");
        event.preventDefault();
        return;
    }

    // Validación Parentesco (solo letras y espacios, si se ingresa)
    if (parentesco !== "" && !soloLetras.test(parentesco)) {
        alert("Error: Parentesco solo puede contener letras y espacios.");
        event.preventDefault();
        return;
    }

    // Validación Dirección (letras, números y caracteres especiales permitidos)
    if (direccionFamiliar !== "" && !letrasYNumeros.test(direccionFamiliar)) {
        alert("Error: Dirección solo puede contener letras, números y algunos caracteres especiales.");
        event.preventDefault();
        return;
    }

    // Si pasa todas las validaciones, el formulario se enviará
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

    $(function () {
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

    function viewModal(referencia) {
        var modalBody = document.getElementById('viewModalBody');
        modalBody.innerHTML = `
            <p><strong>Nombre:</strong> ${referencia.nombre_familiar}</p>
            <p><strong>Parentesco:</strong> ${referencia.parentesco || 'No especificado'}</p>
            <p><strong>Dirección:</strong> ${referencia.direccion_familiar || 'No disponible'}</p>
            <p><strong>Creado por:</strong> ${referencia.creado_por}</p>
            <p><strong>Creado en:</strong> ${referencia.creado_en ? new Date(referencia.creado_en).toLocaleString() : 'No disponible'}</p>
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
</script>
@stop
