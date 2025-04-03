@extends('adminlte::page')

@section('title', 'Gestión de Relaciones de Solicitud')


@section('content_header')
<h1><b>Relacion Solicitud</b></h1>
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
            <h3 class="card-title">Gestión de Relaciones de Solicitud</h3>
            <div class="card-tools">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert">
                                <i class="fas fa-plus"></i> Añadir Nuevo
                                </button>
                        </div>
                        </div>

                        <!-- Contenedor de la tabla -->
                        <div class="card-body">
                        <div class="table-responsive">
                                <table id="relacionTable"  class="table table-bordered table-hover table-striped table-sm">
                                    <thead>
                                        <tr>
                                <th style="text-align: center">ID Relación</th>
                                <th style="text-align: center">ID Solicitud</th>
                                <th style="text-align: center">Nombre</th>
                                <th style="text-align: center">Cónyuge</th>
                                <th style="text-align: center">Ingresos</th>
                                <th style="text-align: center">Egresos</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($solicitudes as $solicitud)
                                <tr>
                                    <td style="text-align: center">{{ $solicitud['id_relacion'] }}</td>
                                    <td>{{ $solicitud['id_solicitud'] }}</td>
                                    <td>{{ $solicitud['nombre_persona'] }}</td>
                                    <td>{{ $solicitud['nombre_conyuge'] }}</td>
                                    <td>{{ $solicitud['ingresos'] }}</td>
                                    <td>{{ $solicitud['egresos'] }}</td>
                                    <td style="text-align: center">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm"
                                            onclick="viewModal({{ json_encode($solicitud) }})">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('relacion.show', $solicitud['id_relacion'])}}" class="btn btn-success btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ route('amortizacion', $solicitud['id_solicitud']) }}" class="btn btn-outline-info btn-sm" title="Ver Tabla de Amortización">
                                            <i class="fas fa-file-alt"></i>
                                        </a>
                                        <form action="{{ route('relacion.destroy', $solicitud['id_relacion']) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

    <div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Información de Solicitud</h5>
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
                <h5 class="modal-title" id="insertModalLabel">Insertar Nueva Relación de Solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="insertForm" action="{{ route('relacion.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">

                        <x-adminlte-select name="id_persona" label="Seleccionar Persona" fgroup-class="mb-3" id="id_persona" required>
                        <option value="">Seleccione una persona</option>
                        @foreach ($personas as $persona)
                         <option value="{{ $persona->id_persona }}">
                         {{ $persona->nombres_apellidos }} - {{ $persona->n_identidad }}
                        </option>
                        @endforeach



                        
                        </x-adminlte-select>
                        <x-adminlte-select name="id_solicitud" id="id_solicitud" label="ID Solicitud" fgroup-class="mb-3" required>
                        <option value="">Selecciona una solicitud</option>
                        </x-adminlte-select>

                            

                        <label for="id_ingresos">ID Ingresos</label>
                        <select name="id_ingresos" id="id_ingresos" class="form-control" required>
                        <option value="">Seleccione un ingreso</option>
                    </select>



                            
                        </div>
                        <div class="col-md-6">
                        <div class="form-group mb-3">
                        <label for="id_conyuge">ID Cónyuge</label>
                        <select name="id_conyuge" id="id_conyuge" class="form-control" required>
       
                        </select>

                        
                        
                        <div class="form-group mb-3">
    
       
                        </select>
                    </div>
                        
<x-adminlte-select name="id_aval1" label="Seleccionar Aval 1" fgroup-class="mb-3">
                                <option value="">Seleccione un aval</option>
                                @foreach ($avales as $aval)
                                    <option value="{{ $aval->id_persona }}">
                                        {{ $aval->nombres_apellidos }} - {{ $aval->n_identidad }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                            <x-adminlte-select name="id_aval2" label="Seleccionar Aval 2" fgroup-class="mb-3">
                                <option value="">Seleccione un aval</option>
                                @foreach ($avales as $aval)
                                    <option value="{{ $aval->id_persona }}">
                                        {{ $aval->nombres_apellidos }} - {{ $aval->n_identidad }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>

                            <x-adminlte-select name="id_aval3" label="Seleccionar Aval 3" fgroup-class="mb-3">
                                <option value="">Seleccione un aval</option>
                                @foreach ($avales as $aval)
                                    <option value="{{ $aval->id_persona }}">
                                        {{ $aval->nombres_apellidos }} - {{ $aval->n_identidad }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <x-adminlte-button label="Cancelar" data-bs-dismiss="modal" class="btn-secondary" />
                        <x-adminlte-button class="btn-flat" type="submit" id="btnGuardar" label="Guardar Relación" theme="success" icon="fas fa-lg fa-save" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("id_persona").addEventListener("change", function () {
            let idPersona = this.value;
            let conyugeSelect = document.getElementById("id_conyuge");

            // Limpiar el select antes de cargar nuevos datos
            conyugeSelect.innerHTML = '<option value="">Buscando cónyuge</option>';

            if (idPersona) {
                fetch(`/https://goldfish-app-q3ucp.ondigitalocean.app/api/Conyuge/${idPersona}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.id_conyuge) {
                            conyugeSelect.innerHTML += `<option value="${data.id_conyuge}" selected>
                                ${data.nombres_conyuge} - ${data.identidad_conyuge}
                            </option>`;
                        }
                    })
                    .catch(error => console.error("Error obteniendo el cónyuge:", error));
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let personaSelect = document.getElementById("id_persona");
        let solicitudSelect = document.getElementById("id_solicitud");

        if (personaSelect) {
            personaSelect.addEventListener("change", function () {
                let idPersona = this.value;

                // Limpiar el select antes de cargar datos nuevos
                solicitudSelect.innerHTML = '<option value="">Cargando...</option>';

                if (idPersona) {
                    console.log("Buscando solicitudes para:", idPersona);

                    fetch(`https://goldfish-app-q3ucp.ondigitalocean.app/api/solicitudes/${idPersona}`)
                        .then(response => {
                            console.log("Respuesta recibida:", response);
                            return response.json();
                        })
                        .then(data => {
                            console.log("Datos recibidos:", data);
                            solicitudSelect.innerHTML = '<option value="">Seleccione una solicitud</option>';

                            if (data.error) {
                                solicitudSelect.innerHTML = `<option value="">${data.error}</option>`;
                                return;
                            }

                            if (Array.isArray(data) && data.length > 0) {
                                data.forEach(solicitud => {
                                    let option = document.createElement("option");
                                    option.value = solicitud.id_solicitud;
                                    option.textContent = `ID: ${solicitud.id_solicitud}`; // Solo se muestra el ID
                                    solicitudSelect.appendChild(option);
                                });
                            } else {
                                solicitudSelect.innerHTML = '<option value="">No hay solicitudes</option>';
                            }
                        })
                        .catch(error => {
                            console.error("Error al cargar solicitudes:", error);
                            solicitudSelect.innerHTML = '<option value="">Error al cargar</option>';
                        });
                } else {
                    solicitudSelect.innerHTML = '<option value="">Seleccione una persona</option>';
                }
            });
        } else {
            console.error("El elemento con id 'id_persona' no fue encontrado.");
        }
    });
</script>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("id_persona").addEventListener("change", function () {
            let idPersona = this.value;
            let ingresosSelect = document.getElementById("id_ingresos");

            // Limpiar el select antes de cargar nuevos datos
            ingresosSelect.innerHTML = '<option value="">Buscando ingreso</option>';

            if (idPersona) {
                fetch(`https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos/${idPersona}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.id_ingresos) {
                            ingresosSelect.innerHTML += `<option value="${data.id_ingresos}" selected>
                                ${data.id_ingresos} - ${data.total_ingresos}
                            </option>`;
                        }
                    })
                    .catch(error => console.error("Error obteniendo el ingreso:", error));
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
            $('#relacionTable').DataTable({ // Inicializa DataTables en tu tabla "relacionTable"
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
            <p><strong>Nombre del Solicitante:</strong> ${solicitud.nombre_persona}</p>
            <p><strong>Cónyuge:</strong> ${solicitud.nombre_conyuge || 'No disponible'}</p>
            <p><strong>Ingresos:</strong> ${solicitud.ingresos}</p>
            <p><strong>Egresos:</strong> ${solicitud.egresos}</p>
            <p><strong>Aval 1:</strong> ${solicitud.nombre_aval1 || 'No disponible'}</p>
            <p><strong>Aval 2:</strong> ${solicitud.nombre_aval2 || 'No disponible'}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Aval 3:</strong> ${solicitud.nombre_aval3 || 'No disponible'}</p>
            <p><strong>Creado por:</strong> ${solicitud.creado_por}</p>
            <p><strong>Creado en:</strong> ${solicitud.creado_en ? new Date(solicitud.creado_en).toLocaleString() : 'No disponible'}</p>
            <p><strong>Modificado por:</strong> ${solicitud.modificado_por || 'No disponible'}</p>
            <p><strong>Modificado en:</strong> ${solicitud.modificado_en ? new Date(solicitud.modificado_en).toLocaleString() : 'No disponible'}</p>
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
@stop

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

