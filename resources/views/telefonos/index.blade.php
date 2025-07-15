@extends('adminlte::page')

@section('title', 'Gestión de Telefonos')

@section('content_header')
<h1><b>Listado de Telefonos</b></h1>
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
                    <h3 class="card-title">Gestion de telefonos</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert">
                            <i class="fas fa-plus"></i> Nueva Telefono
                        </button>
                    </div>
                </div>

                <div class="card-body">
                <div class="table-responsive">
                        <table id="relacionTable" class="table table-bordered table-hover table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center" data-order="asc">ID telefono</th>
                                    <th style="text-align: center">Telefono</th>
                                    <th style="text-align: center">tipo</th>
                                    <th style="text-align: center">entidad</th>
                                    <th style="text-align: center">Nombre</th>
                                    <th style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach(collect($telefonos)->sortBy(fn($p) => (int) $p['id_telefono']) as $telefono)
                                    <tr>
                                        <td style="text-align: center" data-order="asc">{{ $telefono['id_telefono'] }}</td>
                                        <td style="text-align: center">{{ $telefono['numero'] }}</td>
                                        <td style="text-align: center">{{ $telefono['tipo_telefono'] }}</td>
                                        <td style="text-align: center">{{ $telefono['tipo_entidad'] }}</td>
                                        <td >{{ $telefono['nombre_persona'] }}</td>
                                        <td style="text-align: center">
                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm"
                                                onclick="viewModal({{ json_encode($telefono) }})">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('telefonos.show', $telefono['id_telefono']) }}"
                                            class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('telefonos.destroy', $telefono['id_telefono']) }}"
                                                method="POST" class="d-inline delete-form">
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

                <!-- Modal para agregar un nuevo telefono -->
                    <div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewModalLabel">Información de Telefono</h5>
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
                </div>



                {{-- Modal para Insertar Nuevo Teléfono --}}
                <div class="modal fade" id="insert" tabindex="-1" aria-labelledby="insertTelefonoLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="insertTelefonoLabel">Agregar Nuevo Teléfono</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="insertTelefonoForm" action="{{ route('telefonos.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <x-adminlte-select name="id_entidad" label="Seleccionar Persona"
                                                fgroup-class="mb-3" required>
                                                <option value="">Seleccione una persona</option>
                                                @foreach ($personas as $persona)
                                                    <option value="{{ $persona->id_persona }}">
                                                        {{ $persona->nombres_apellidos }} - {{ $persona->n_identidad }}
                                                    </option>
                                                @endforeach
                                            </x-adminlte-select>

                                            <x-adminlte-select name="tipo_entidad" label="Tipo de Entidad"
                                                fgroup-class="mb-3" required>
                                                <option value="">Seleccione...</option>
                                                <option value="Solicitante">Solicitante</option>
                                                <option value="Aval">Aval</option>
                                                <option value="Conyuge">Cónyuge</option>
                                                <option value="ReferenciaFamiliar">Referencia Familiar</option>
                                            </x-adminlte-select>
                                        </div>

                                        <div class="col-md-6">
                                            <x-adminlte-select name="tipo" label="Tipo de Teléfono" fgroup-class="mb-3"
                                                required>
                                                <option value="">Seleccione...</option>
                                                <option value="Residencial">Residencial</option>
                                                <option value="Celular">Celular</option>
                                                <option value="Trabajo">Trabajo</option>
                                            </x-adminlte-select>

                                            <x-adminlte-input name="numero" label="Número de Teléfono" type="text"
                                                fgroup-class="mb-3" placeholder="Ej: 2345-6789" required
    pattern="^[2389]\d{3}-\d{4}$" maxlength="9"
    title="El número debe tener el formato ####-#### y comenzar con 2, 3, 8 o 9."
    id="numero" />

                                            

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <x-adminlte-button label="Cancelar" data-bs-dismiss="modal"
                                            class="btn-secondary" />
                                        <x-adminlte-button class="btn-flat" type="submit" label="Guardar Teléfono"
                                            theme="success" icon="fas fa-lg fa-save" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @stop

<script>
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("numero");

    if (input) {
        // Crear contenedor de error
        const error = document.createElement('div');
        error.classList.add('text-danger');
        error.style.fontSize = '0.875rem';
        error.style.display = 'none';
        input.parentElement.appendChild(error);

        // Formatear con guion automáticamente mientras se escribe
        input.addEventListener("input", function () {
            let valor = this.value.replace(/\D/g, ''); // Eliminar todo lo que no sea número

            // Limitar a 8 dígitos
            valor = valor.substring(0, 8);

            // Insertar guion después de 4 dígitos
            if (valor.length > 4) {
                valor = valor.substring(0, 4) + '-' + valor.substring(4);
            }

            this.value = valor;
            error.style.display = 'none';
        });

        // Validar formato al salir del campo
        input.addEventListener("blur", function () {
            const valor = this.value.trim();
            if (!/^[2389]\d{3}-\d{4}$/.test(valor)) {
                error.textContent = "Debe ingresar 8 dígitos en formato ####-#### y comenzar con 2, 3, 8 o 9.";
                error.style.display = 'block';
            } else {
                error.style.display = 'none';
            }
        });

        // Validación al enviar el formulario
        const form = document.getElementById("insertTelefonoForm");
        form.addEventListener("submit", function (event) {
            const valor = input.value.trim();
            const regex = /^[2389]\d{3}-\d{4}$/;

            if (!regex.test(valor)) {
                error.textContent = "Debe ingresar 8 dígitos en formato ####-#### y comenzar con 2, 3, 8 o 9.";
                error.style.display = 'block';
                event.preventDefault(); // Detener envío
            } else {
                error.style.display = 'none';
            }
        });
    }
});
</script>



            @section('js')
            <script src="//cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
             
                    $(function() {
                        $('#relacionTable').DataTable({ // Inicializa DataTables en tu tabla "relacionTable"
                            "order": [[0, "asc"]], // Orden ascendente por ID
        "pageLength": 10,        // Número de registros por página
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
            { text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-success' }
        ]
    });
});

                    function viewModal(telefono) {
                        var modalBody = document.getElementById('viewModalBody');
                        modalBody.innerHTML = `
        <div class="col-md-6">
            <p><strong>ID telefono:</strong> ${telefono.id_telefono}</p>
            <p><strong>Telefono:</strong> ${telefono.numero}</p>
            <p><strong>Tipo telefono:</strong> ${telefono.tipo_telefono}</p>
            <p><strong>Tipo entidad:</strong> ${telefono.tipo_entidad}</p>
            <p><strong>Nombre persona:</strong> ${telefono.nombre_persona}</p>
        </div>
    `;

                        var viewModalElement = new bootstrap.Modal(document.getElementById('view'));
                        viewModalElement.show();
                    }


                    document.addEventListener("DOMContentLoaded", function () {
        // Selecciona todos los formularios de eliminación
        document.querySelectorAll(".delete-form").forEach(form => {
            form.addEventListener("submit", function (event) {
                event.preventDefault(); // Evita que el formulario se envíe inmediatamente
                
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
                        form.submit(); // Solo envía el formulario si el usuario confirma
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
