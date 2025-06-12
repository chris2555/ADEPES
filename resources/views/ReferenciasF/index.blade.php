@extends('adminlte::page')

@section('Referencias', 'Gestión de Referencias ')


@section('content_header')
<h1><b>Listado de Referencias </b></h1>
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
                    <h3 class="card-title">Gestión de Referencias </h3>
                    <div class="card-tools">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevareferencia">
                <i class="fas fa-plus"></i> Nueva Referencia
            </button>
            </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
            <table id="referenciasTable" class="table table-bordered table-hover table-striped table-sm">
            <thead>
                <tr>
                        <th style="text-align: center" data-order="asc">ID</th>
                        <th style="text-align: center">ID Persona</th>
                        <th style="text-align: center">Nombre Pariente</th>
                        <th style="text-align: center">Nombre Familiar</th>
                        <th style="text-align: center">Parentesco</th>
                        <th style="text-align: center">Telefono 1</th>
                        <th style="text-align: center">Dirección</th>
                        <th style="text-align: center">Acciones</th>
                        </tr>
                            </thead>
                            <tbody>
                            @foreach(collect($referencias)->sortBy(fn($p) => (int) $p['id_referencia']) as $referencia)
                        <tr>
                        <td>{{ $referencia['id_referencia'] }}</td>
                        <td>{{ $referencia['id_persona'] }}</td>
                        <td>{{ $referencia['nombres_persona'] }}</td>
                        <td>{{ $referencia['nombre_familiar'] }}</td>
                        <td>{{ $referencia['parentesco'] }}</td>
                        <td>{{ $referencia['telref1'] }}</td>
                        <td>{{ $referencia['direccion_familiar'] }}</td>
                            <td td style="text-align: center">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" 
                                onclick="viewModal({{ json_encode($referencia) }})">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('referencias.show', $referencia['id_referencia']) }}" 
                                class="btn btn-success btn-sm">
                                 <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('referencias.destroy', $referencia['id_referencia']) }}" 
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
    let table = document.getElementById("referenciasTable");
    let rows = Array.from(table.rows).slice(1); // Omitimos el encabezado
    let sortedRows = rows.sort((a, b) => {
        return a.cells[columnIndex].innerText - b.cells[columnIndex].innerText;
    });

    </script>
                    </div>
                </div>
            </div>
        </div>
        
<!-- Modal de Visualización  include('referencias.modal_create'  include('referencias.modal_view')) -->
<div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Información de Referencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="viewModalBody"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal para Insertar Nueva Referencia -->
<div class="modal fade" id="nuevareferencia" tabindex="-1" aria-labelledby="nuevareferenciaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Cambiado a modal-xl para más espacio -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Nueva Referencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="insertForm" action="{{ route('referencias.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Selección de Persona -->
                    @if(isset($personas))
                        <x-adminlte-select name="id_persona" label="Seleccionar Familiar" fgroup-class="mb-3" required>
                            <option value="">Seleccione un Familiar</option>
                            @foreach ($personas as $persona)
                                <option value="{{ $persona['id_persona'] }}">
                                    Nombre: {{ $persona['nombres_apellidos'] }} - ID Persona: {{ $persona['id_persona'] }}
                                </option>
                            @endforeach
                        </x-adminlte-select>
                    @endif

                    <!-- Referencias Familiares -->
                    <h5 class="mb-3">Referencias Familiares</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input name="nombre_familiar" id="nombre_familiar" label="Nombre del Familiar 1" required fgroup-class="mb-3" />
                            <x-adminlte-input name="parentesco" id="parentesco" label="Parentesco" required fgroup-class="mb-3" />
                            <x-adminlte-input name="telref1" id="telref1" label="Teléfono Familiar 1" type="text"
                                fgroup-class="mb-3" placeholder="Ingrese el número" required
                                pattern="[2389][0-9]{7}" maxlength="8"
                                title="El número debe tener 8 dígitos y comenzar con 2, 3, 8 o 9." />
                            <x-adminlte-textarea name="direccion_familiar" id="direccion_familiar" label="Dirección" required fgroup-class="mb-3" rows="3" />
                        </div>

                        <div class="col-md-6">
                            <x-adminlte-input name="nombre_familiardos" id="nombre_familiardos" label="Nombre del Familiar 2" required fgroup-class="mb-3" />
                            <x-adminlte-input name="parentesco_dos" id="parentesco_dos" label="Parentesco" required fgroup-class="mb-3" />
                            <x-adminlte-input name="telref2" id="telref2" label="Teléfono Familiar 2" type="text"
                                fgroup-class="mb-3" placeholder="Ingrese el número" required
                                pattern="[2389][0-9]{7}" maxlength="8"
                                title="El número debe tener 8 dígitos y comenzar con 2, 3, 8 o 9." />
                            <x-adminlte-textarea name="direccion_familiardos" id="direccion_familiardos" label="Dirección" required fgroup-class="mb-3" rows="3" />
                        </div>
                    </div>

                    <!-- Referencias Personales -->
                    <h5 class="mt-4 mb-3">Referencias Personales</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input name="nombreper1" id="nombreper1" label="Nombre Persona 1" required fgroup-class="mb-3" />
                            <x-adminlte-input name="relacionper1" id="relacionper1" label="Relación con Persona " required fgroup-class="mb-3" />
                            <x-adminlte-input name="telrefper1" id="telrefper1" label="Teléfono Persona " type="text"
                                fgroup-class="mb-3" placeholder="Ingrese el número" required
                                pattern="[2389][0-9]{7}" maxlength="8"
                                title="El número debe tener 8 dígitos y comenzar con 2, 3, 8 o 9." />
                            <x-adminlte-textarea name="direccionper1" id="direccionper1" label="Dirección Persona " required fgroup-class="mb-3" rows="3" />
                        </div>

                        <div class="col-md-6">
                            <x-adminlte-input name="nombreper2" id="nombreper2" label="Nombre Persona 2" required fgroup-class="mb-3" />
                            <x-adminlte-input name="relacionper2" id="relacionper2" label="Relación con Persona " required fgroup-class="mb-3" />
                            <x-adminlte-input name="telrefper2" id="telrefper2" label="Teléfono Persona " type="text"
                                fgroup-class="mb-3" placeholder="Ingrese el número" required
                                pattern="[2389][0-9]{7}" maxlength="8"
                                title="El número debe tener 8 dígitos y comenzar con 2, 3, 8 o 9." />
                            <x-adminlte-textarea name="direccionper2" id="direccionper2" label="Dirección Persona " required fgroup-class="mb-3" rows="3" />
                        </div>
                    </div>
                </div>

                <!-- Campo oculto de usuario -->
                <input type="hidden" name="creado_por" value="{{ auth()->user()->id }}">

                <!-- Footer -->
                <div class="modal-footer">
                    <x-adminlte-button label="Cerrar" data-bs-dismiss="modal" class="btn-secondary" />
                    <x-adminlte-button type="submit" label="Guardar Referencia" theme="success" icon="fas fa-save" />
                </div>
            </form>
        </div>
    </div>
</div>

            

                <script>
// Expresión regular que permite solo letras, espacios y tildes
const soloLetrasRegex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/;

function validarCampoSoloLetras(input) {
    input.addEventListener("input", function () {
        if (!soloLetrasRegex.test(this.value)) {
            this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const campos = [
        "nombre_familiar",
        "parentesco",
        "nombre_familiardos",
        "parentesco_dos"
    ];

    // Aplicar validación en tiempo real
    campos.forEach(id => {
        const campo = document.getElementById(id);
        if (campo) {
            validarCampoSoloLetras(campo);
        }
    });

    // Validación al enviar el formulario
    const form = document.getElementById("insertForm");
    form.addEventListener("submit", function (event) {
        for (let id of campos) {
            const input = document.getElementById(id);
            const valor = input.value.trim();
            if (!soloLetrasRegex.test(valor) || valor === "") {
                alert(`Error: El campo '${input.labels[0].innerText}' solo puede contener letras y espacios.`);
                event.preventDefault();
                return;
            }
        }
    });
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
        $('#referenciasTable').DataTable({ // Inicializa DataTables en tu tabla "relacionTable"
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
<div class="row">
  <div class="col-md-6">
    <p><strong>Nombre Familiar 1:</strong> ${referencia.nombre_familiar}</p>
    <p><strong>Parentesco:</strong> ${referencia.parentesco || 'No especificado'}</p>
    <p><strong>Teléfono:</strong> ${referencia.telref1 || 'No especificado'}</p>
    <p><strong>Dirección:</strong> ${referencia.direccion_familiar || 'No disponible'}</p>
  </div>
  <div class="col-md-6">
    <p><strong>Nombre Familiar 2:</strong> ${referencia.nombre_familiardos}</p>
    <p><strong>Parentesco:</strong> ${referencia.parentesco_dos || 'No especificado'}</p>
    <p><strong>Teléfono:</strong> ${referencia.telref2 || 'No especificado'}</p>
    <p><strong>Dirección:</strong> ${referencia.direccion_familiardos || 'No disponible'}</p>
  </div>
</div>

<!-- Referencias Personales -->
<div class="row">
  <div class="col-md-6">
    <p><strong>Referencia Personal 1:</strong></p>
    <p><strong>Nombre:</strong> ${referencia.nombreper1 || 'No especificado'}</p>
    <p><strong>Relación:</strong> ${referencia.relacionper1 || 'No especificado'}</p>
    <p><strong>Teléfono:</strong> ${referencia.telrefper1 || 'No especificado'}</p>
    <p><strong>Dirección:</strong> ${referencia.direccionper1 || 'No disponible'}</p>
    <p><strong>Creado por:</strong> ${referencia.creado_por}</p>
    <p><strong>Modificador por:</strong> ${referencia.modificado_por}</p>
  </div>
  <div class="col-md-6">
    <p><strong>Referencia Personal 2:</strong></p>
    <p><strong>Nombre:</strong> ${referencia.nombreper2 || 'No especificado'}</p>
    <p><strong>Relación:</strong> ${referencia.relacionper2 || 'No especificado'}</p>
    <p><strong>Teléfono:</strong> ${referencia.telrefper2 || 'No especificado'}</p>
    <p><strong>Dirección:</strong> ${referencia.direccionper2 || 'No disponible'}</p>
    <p><strong>Creado en:</strong> ${referencia.creado_en ? new Date(referencia.creado_en).toLocaleString() : 'No disponible'}</p>
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

