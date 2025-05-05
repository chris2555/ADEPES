@extends('adminlte::page')

@section('conyuge', 'Gestion de Conyuge')

@section('content_header')
<h1><b>Listado de Conyuge</b></h1>
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
            <h3 class="card-title">DATOS CONYUGE</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert">
                <i class="fas fa-plus"></i> Nuevo Conyuge
            </button>
            </div>
            </div>

            <div class="card-body">
            <div class="table-responsive">
                <table id="relacionTable" class="table table-bordered table-hover table-striped table-sm">
                    <thead>
                        <tr>
                            <th style="text-align: center" data-order="asc">ID Conyuge</th>
                            <th style="text-align: center">ID persona</th>
                            <th style="text-align: center">Nombre Solicitante</th>
                            <th style="text-align: center">Nombre Conyuge</th>
                            <th style="text-align: center">Fecha Nacimiento</th>
                            <th style="text-align: center">Identidad</th>
                            <th style="text-align: center">Direccion</th>
                            <th style="text-align: center">Profesion</th>
                            <th style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(collect($solicitudes)->sortBy(fn($p) => (int) $p['id_conyuge']) as $solicitud)
                        <tr>
                            <td style="text-align: center" data-order="asc">{{ $solicitud['id_conyuge'] }}</td>
                            <td>{{ $solicitud['id_persona'] }}</td>
                            <td>{{ $solicitud['nombres_persona'] }}</td>
                            <td>{{ $solicitud['nombres_conyuge'] }}</td>
                            <td>{{ $solicitud['fecha_nacimiento_conyuge'] }}</td>
                            <td>{{ $solicitud['identidad_conyuge'] }}</td>
                            <td>{{ $solicitud['direccion_conyuge'] }}</td>
                            <td>{{ $solicitud['profesion_oficio_conyuge'] }}</td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-success btn-sm"
                                    onclick="viewModal({{ json_encode($solicitud) }})">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('conyuge.show', $solicitud['id_conyuge']) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('conyuge.destroy', $solicitud['id_conyuge']) }}"
                                    method="POST" class="d-inline">
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
                        </div>

<!-- Modal para Insertar Nuevo Conyuge -->
<div class="modal fade" id="insert" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel">Insertar Nuevo conyuge</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="insertForm" action="{{ route('conyuge.store') }}" method="POST" onsubmit="return validarFormulario(event)">
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

                            <x-adminlte-input name="nombres_conyuge" label="Nombre del Cónyuge" type="text" fgroup-class="mb-3" required
                                placeholder="Ingrese el nombre del cónyuge" />
                                <div class="text-danger" id="error_nombre"></div>

                            <x-adminlte-input name="fecha_nacimiento_conyuge" label="Fecha de Nacimiento del Cónyuge" type="date" fgroup-class="mb-3" required />
                            <div class="text-danger" id="error_fecha"></div>

                            <x-adminlte-input name="identidad_conyuge" label="Identidad del Cónyuge" type="text" fgroup-class="mb-3" required maxlength="13" oninput="soloNumeros(this)" required
                                placeholder="Ingrese la identidad del cónyuge" />
                                <div class="text-danger" id="error_identidad"></div>

                            <x-adminlte-textarea name="direccion_conyuge" label="Dirección del Cónyuge" fgroup-class="mb-3" required
                                placeholder="Ingrese la dirección del cónyuge" />

                            <x-adminlte-input name="profesion_oficio_conyuge" label="Profesión u Oficio del Cónyuge" type="text" fgroup-class="mb-3" required
                                placeholder="Ingrese la profesión u oficio del cónyuge" />

                            <x-adminlte-input name="cargo_conyuge" label="Cargo del Cónyuge" type="text" fgroup-class="mb-3" required
                                placeholder="Ingrese el cargo del cónyuge" />
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input name="ingresos_negocio_conyuge" label="Ingresos del Cónyuge" type="number" fgroup-class="mb-3" required
                                placeholder="Ingrese los ingresos" step="0.01" min="0" />

                                <x-adminlte-input name="gastos_alimentacion_conyuge" label="Gastos de Alimentación del Cónyuge" type="number" fgroup-class="mb-3" required
                                placeholder="Ingrese los gastos de alimentación" step="0.01" min="0" />

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

                            <x-adminlte-input name="estado_credito_conyuge" label="Creditos en ADEPES" type="text" fgroup-class="mb-3" required
                                placeholder="sin credito o con credito" />

                                <x-adminlte-input name="telefono_conyuge" label="Telefono conyuge" type="text" fgroup-class="mb-3" required
                                 />

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar Conyuge</button>
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

   
    let nombre = document.getElementById("nombres_conyuge").value.trim();
    let regexNombre = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/; // Solo letras y espacios

    if (nombre.length < 3) {
        document.getElementById("error_nombre").textContent = "El nombre debe tener al menos 3 caracteres.";
        valido = false;
    } else if (!regexNombre.test(nombre)) {
        document.getElementById("error_nombre").textContent = "El nombre no debe contener números ni caracteres especiales.";
        valido = false;
    }

    // Validar número de identidad
    let identidad = document.getElementById("identidad_conyuge").value.trim();
    if (!/^\d{13}$/.test(identidad)) {
        document.getElementById("error_identidad").textContent = "El número de identidad debe contener exactamente 13 dígitos sin guiones.";
        valido = false;
    }

    // Validar fecha de nacimiento
    let fechaNacimiento = document.getElementById("fecha_nacimiento_conyuge").value;
    if (fechaNacimiento) {
        let fechaNacimientoDate = new Date(fechaNacimiento);
        let hoy = new Date();
        let edad = hoy.getFullYear() - fechaNacimientoDate.getFullYear();
        let diferenciaMeses = hoy.getMonth() - fechaNacimientoDate.getMonth();
        let diferenciaDias = hoy.getDate() - fechaNacimientoDate.getDate();

        // Ajustar edad si el cumpleaños aún no ha ocurrido este año
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

    if (!valido) {
        let modal = new bootstrap.Modal(document.getElementById('insert'));
        modal.show();
    } else {
        event.target.submit();
    }
  }
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    function validarSoloNumeros(input) {
        input.addEventListener("input", function () {
            this.value = this.value.replace(/\D/g, ""); // Elimina cualquier cosa que no sea número
        });
    }

    // Aplicar la validación a los campos específicos
    validarSoloNumeros(document.querySelector("input[name='identidad_conyuge']"));

    // Agregar evento submit al formulario
    document.getElementById("insert").addEventListener("submit", validarFormulario);
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    function validarTextoSinNumeros(input) {
        input.addEventListener("input", function () {
            this.value = this.value.replace(/\d/g, ""); // Elimina cualquier número ingresado
        });
    }

    // Aplicar la validación a los campos específicos
    validarTextoSinNumeros(document.querySelector("input[name='nombres_conyuge']"));
    validarTextoSinNumeros(document.querySelector("input[name='profesion_oficio_conyuge']"));
    validarTextoSinNumeros(document.querySelector("input[name='cargo_conyuge']"));
    validarTextoSinNumeros(document.querySelector("input[name='estado_credito_conyuge']"));

    // Agregar evento submit al formulario
    document.getElementById("insert").addEventListener("submit", validarFormulario);
});
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
   

    function viewModal(solicitud) {
        var modalBody = document.getElementById('viewModalBody');
        modalBody.innerHTML = `
        <div class="col-md-6">
            <p><strong>id del conyuge:</strong> ${solicitud.id_conyuge}</p>
            <p><strong>Nombre del Conyuge:</strong> ${solicitud.nombres_conyuge  || 'No disponible'}</p>
            <p><strong>Nombre del Solicitante:</strong> ${solicitud.nombres_persona  || 'No disponible'}</p>
            <p><strong>Fecha de Nacimiento:</strong> ${solicitud.fecha_nacimiento_conyuge }</p>
            <p><strong>Identidad:</strong> ${solicitud.identidad_conyuge }</p>
            <p><strong>Direccion:</strong> ${solicitud.direccion_conyuge  || 'No disponible'}</p>
            <p><strong>Telefono:</strong> ${solicitud.telefono_conyuge  || 'No disponible'}</p>
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
    viewModalElement.show()
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

