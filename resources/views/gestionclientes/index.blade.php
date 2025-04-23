@extends('adminlte::page')

@section('title', 'Gestión de Clientes')

@section('content_header')
<h1><b>Listado de Clientes</b></h1>
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
            <h3 class="card-title">DATOS PERSONALES</h3>
            <div class="card-tools">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoClienteModal">
                                <i class="fas fa-plus"></i> Nuevo Cliente
                            </button>
                        </div>
                        </div>

                        <div class="card-body">
                        <div class="table-responsive">
                                <table id="clienteTable"  class="table table-bordered table-hover table-striped table-sm">
                                    <thead>
                                        <tr>
                                        <th style="text-align: center" data-order="asc"">Id</th>
                                        <th style="text-align: center">Nombre</th>
                                        <th style="text-align: center">Identidad</th>
                                        <th style="text-align: center">Edad</th>
                                        <th style="text-align: center">Estado Civil</th>
                                        <th style="text-align: center">Género</th>
                                        <th style="text-align: center">Teléfono</th>
                                        <th style="text-align: center">Email Personal</th>
                                        <th style="text-align: center">Email Laboral</th>
                                        <th style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                @foreach(collect($personas)->sortBy(fn($p) => (int) $p['id_persona']) as $persona)
                                        <tr>
                                        <td style="text-align: center" data-order="asc">{{ $persona['id_persona'] }}</td>
                                        <td>{{ $persona['nombres_apellidos'] }}</td>
                                        <td style="text-align: center">{{ $persona['n_identidad'] }}</td>
                                        <td style="text-align: center">{{ $persona['edad'] }}</td>
                                        <td>{{ $persona['estado_civil'] }}</td>
                                        <td>{{ $persona['genero'] }}</td>
                                        <td>{{ $persona['telefono_secundario'] }}</td>
                                        <td>{{ $persona['email_personal'] }}</td>
                                        <td>{{ $persona['email_laboral'] }}</td>
                                        <td style="text-align: center">

                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm"
                                        onclick="viewModal({{ json_encode($persona) }})">
                                        <i class="bi bi-eye"></i>
                                        </a>
                                            <a href="{{ route('gestionclientes.show', $persona['id_persona'])}}" 
                                            class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        <form action="{{ route('gestionclientes.destroy', $persona['id_persona']) }}" 
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
    let table = document.getElementById("clienteTable");
    let rows = Array.from(table.rows).slice(1); // Omitimos el encabezado
    let sortedRows = rows.sort((a, b) => {
        return a.cells[columnIndex].innerText - b.cells[columnIndex].innerText;
    });
    </script>
                </div>

<!-- Modal para agregar un nuevo cliente -->
<div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel">Información de Clientes</h5>
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

                        <div class="modal fade" id="nuevoClienteModal" tabindex="-1" aria-labelledby="nuevoClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoClienteModalLabel">Añadir Nuevo Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="nuevoClienteForm" action="{{ route('gestionclientes.store') }}" method="POST" onsubmit="return validarFormulario(event)">
                    @csrf
                    <div class="row">
                        <!-- Primera columna -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="nombres_apellidos">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombres_apellidos" name="nombres_apellidos" class="form-control" placeholder="Ingrese el nombre completo" required>
                                <div class="text-danger" id="error_nombre"></div>
                            </div>
                            <div class="mb-3">
                                <label for="n_identidad" class="form-label">Número de Identidad</label>
                                <input type="text" class="form-control" id="n_identidad" name="n_identidad" required maxlength="13" oninput="soloNumeros(this)">
                                <div class="text-danger" id="error_identidad"></div>
                            </div>
                            <div class="mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required oninput="calcularEdad()">
                            <div class="text-danger" id="error_fecha"></div>
                        </div>
                            <div class="mb-3">
                                <label for="edad" class="form-label">Edad</label>
                                <input type="text" class="form-control" id="edad" name="edad" readonly>
                            </div>
                        </div>

                        <!-- Segunda columna -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" required>
                            </div>
                            <div class="mb-3">
                                <label for="estado_civil" class="form-label">Estado Civil</label>
                                <select class="form-control" id="estado_civil" name="estado_civil">
                                    <option value="Soltero">Soltero</option>
                                    <option value="Casado">Casado</option>
                                    <option value="Divorciado">Divorciado</option>
                                    <option value="Viudo">Viudo</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="genero" class="form-label">Género</label>
                                <select class="form-control" id="genero" name="genero">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tipo_persona" class="form-label">Tipo de persona</label>
                                <select class="form-control" id="tipo_persona" name="tipo_persona">
                                    <option value="Solicitante">Solicitante</option>
                                    <option value="Aval">Aval</option>
                                </select>
                            </div>
                        </div>

                        <!-- Tercera columna -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="email_personal" class="form-label">Email Personal</label>
                                <input type="email" class="form-control" id="email_personal" name="email_personal">
                            </div>
                            <div class="mb-3">
                                <label for="email_laboral" class="form-label">Email Laboral</label>
                                <input type="email" class="form-control" id="email_laboral" name="email_laboral">
                            </div>
                            <div class="mb-3">
                            <label for="telefono_secundario" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono_secundario" name="telefono_secundario" required maxlength="9" oninput="soloNumeros(this)" placeholder="Ej: 0000-0000" required>
    <div class="text-danger" id="error_telefono"></div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar Cliente</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function validarFormulario(event) {
    event.preventDefault();
    let valido = true;
    document.querySelectorAll(".text-danger").forEach(el => el.textContent = "");

    let nombre = document.getElementById("nombres_apellidos").value;
    if (nombre.length < 3) {
        document.getElementById("error_nombre").textContent = "El nombre debe tener al menos 3 caracteres.";
        valido = false;
    }

    let identidad = document.getElementById("n_identidad").value;
    if (!/^\d{13}$/.test(identidad)) {
        document.getElementById("error_identidad").textContent = "El número de identidad debe contener exactamente 13 dígitos sin guiones.";
        valido = false;
    }

    let fechaNacimiento = document.getElementById("fecha_nacimiento").value;
    if (fechaNacimiento) {
        let fechaNacimientoDate = new Date(fechaNacimiento);
        let hoy = new Date();
        let edad = hoy.getFullYear() - fechaNacimientoDate.getFullYear();
        let diferenciaMeses = hoy.getMonth() - fechaNacimientoDate.getMonth();
        let diferenciaDias = hoy.getDate() - fechaNacimientoDate.getDate();

        if (diferenciaMeses < 0 || (diferenciaMeses === 0 && diferenciaDias < 0)) {
            edad--;
        }

        if (edad < 18 || edad > 100) {
            document.getElementById("error_fecha").textContent = "Debes ingresar una fecha válida para una persona entre 18 y 100 años.";
            valido = false;
        }
    } else {
        document.getElementById("error_fecha").textContent = "La fecha de nacimiento es obligatoria.";
        valido = false;
    }

    let telefono = document.getElementById("telefono_secundario").value;
    let telefonoRegex = /^[23789]{1}\d{3}-\d{4}$/;
    if (!telefonoRegex.test(telefono)) {
        document.getElementById("error_telefono").textContent = "El teléfono debe ser válido de Honduras (Ej: 0000-0000)";
        valido = false;
    }

    if (!valido) {
        let modal = new bootstrap.Modal(document.getElementById('nuevoClienteModal'));
        modal.show();
    } else {
        event.target.submit();
    }
}

// ✅ ESTA FUNCIÓN DEBE ESTAR FUERA
function calcularEdad() {
    let fechaNacimiento = document.getElementById("fecha_nacimiento").value;
    let edadInput = document.getElementById("edad");

    if (fechaNacimiento) {
        let fechaNacimientoDate = new Date(fechaNacimiento);
        let hoy = new Date();
        let edad = hoy.getFullYear() - fechaNacimientoDate.getFullYear();
        let diferenciaMeses = hoy.getMonth() - fechaNacimientoDate.getMonth();
        let diferenciaDias = hoy.getDate() - fechaNacimientoDate.getDate();

        if (diferenciaMeses < 0 || (diferenciaMeses === 0 && diferenciaDias < 0)) {
            edad--;
        }

        edadInput.value = edad >= 0 ? edad : "";
    } else {
        edadInput.value = "";
    }
}
</script>
<script>
    function validarIdentidad(input) {
        let valor = input.value;

        // Remueve cualquier carácter que no sea número
        valor = valor.replace(/\D/g, '');

        // Limita el valor a 13 dígitos
        if (valor.length > 13) {
            valor = valor.slice(0, 13);
        }

        input.value = valor;

        // Validación visual opcional
        const errorDiv = document.getElementById('error_identidad');
        if (valor.length !== 13) {
            errorDiv.textContent = 'La identidad debe tener exactamente 13 dígitos.';
        } else {
            errorDiv.textContent = '';
        }
    }

    function validarTelefono(input) {
        let valor = input.value;

        // Remueve cualquier carácter que no sea número
        valor = valor.replace(/\D/g, '');

        // Limita el valor a 9 dígitos
        if (valor.length > 9) {
            valor = valor.slice(0, 9);
        }

        input.value = valor;

        // Validación visual opcional
        const errorDiv = document.getElementById('error_telefono');
        if (valor.length !== 9) {
            errorDiv.textContent = 'El teléfono debe tener exactamente 9 dígitos.';
        } else {
            errorDiv.textContent = '';
        }
    }
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
    $('#clienteTable').DataTable({
        "order": [[0, "asc"]], // Orden ascendente por ID
        "pageLength": 5,        // Número de registros por página
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
   
        
   
   function viewModal(personas) {
    var modalBody = document.getElementById('viewModalLabel');
    modalBody.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <p><strong>Nombre del cliente:</strong> ${personas.nombres_apellidos}</p>
                <p><strong>Número de identidad:</strong> ${personas.n_identidad || 'No disponible'}</p>
                <p><strong>Fecha de nacimiento:</strong> ${personas.fecha_nacimiento}</p>
                <p><strong>Edad:</strong> ${personas.edad}</p>
                <p><strong>Nacionalidad:</strong> ${personas.nacionalidad || 'No disponible'}</p>
                <p><strong>Estado civil:</strong> ${personas.estado_civil || 'No disponible'}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Género:</strong> ${personas.genero || 'No disponible'}</p>
                <p><strong>Tipo de cliente:</strong> ${personas.tipo_persona}</p>
                <p><strong>Email personal:</strong> ${personas.email_personal}</p>
                <p><strong>Email laboral:</strong> ${personas.email_laboral}</p>
                <p><strong>Teléfono secundario:</strong> ${personas.telefono_secundario}</p>
                <p><strong>Creado en:</strong> ${personas.creado_en ? new Date(personas.creado_en).toLocaleString() : 'No disponible'}</p>
                <p><strong>Modificado por:</strong> ${personas.modificado_por || 'No disponible'}</p>
                <p><strong>Modificado en:</strong> ${personas.modificado_en ? new Date(personas.modificado_en).toLocaleString() : 'No disponible'}</p>
            </div>
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
