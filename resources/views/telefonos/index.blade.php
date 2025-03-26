@extends('adminlte::page')

@section('title', 'Gestión de Telefonos')

@section('content_header')

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
                                    <th style="text-align: center">ID telefono</th>
                                    <th style="text-align: center">Telefono</th>
                                    <th style="text-align: center">tipo</th>
                                    <th style="text-align: center">entidad</th>
                                    <th style="text-align: center">Nombre</th>
                                    <th style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($telefonos as $telefono)
                                    <tr>
                                        <td style="text-align: center">{{ $telefono['id_telefono'] }}</td>
                                        <td style="text-align: center">{{ $telefono['numero'] }}</td>
                                        <td>{{ $telefono['tipo_telefono'] }}</td>
                                        <td>{{ $telefono['tipo_entidad'] }}</td>
                                        <td>{{ $telefono['nombre_persona'] }}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-success btn-sm"
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
                                                <button type="button" class="btn btn-outline-warning btn-sm delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewModalLabel">Información de Solicitud</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
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
                                                fgroup-class="mb-3" placeholder="Ingrese el número" required
                                                pattern="[2389][0-9]{7}"
                                                title="El número debe tener 8 dígitos y comenzar con 2, 3, 8 o 9."
                                                maxlength="8" id="numero" />

                                            @push('js')
                                                <script>
                                                    document.addEventListener("DOMContentLoaded", function() {
                                                        document.getElementById("numero").addEventListener("input", function() {
                                                            this.value = this.value.replace(/[^0-9]/g, ''); // Solo permite números
                                                        });
                                                    });
                                                </script>
                                            @endpush

                                            

                                            @push('js')
                                                <script>
                                                    document.addEventListener("DOMContentLoaded", function() {
                                                        document.getElementById("numero").addEventListener("input", function() {
                                                            this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
                                                        });
                                                    });
                                                </script>
                                                </script>
                                            @endpush



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


                    document.addEventListener("DOMContentLoaded", function() {
                        document.querySelectorAll('.delete-btn').forEach(button => {
                            button.addEventListener('click', function() {
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

                @if (session('success'))
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

                @if (session('error'))
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
