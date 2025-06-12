@extends('adminlte::page')

@section('Viviendas', 'Gestión de Viviendas')

@section('content_header')
    <h1><b>Listado de Viviendas</b></h1>
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
                    <h3 class="card-title">Gestión de Viviendas</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertVivienda">
                            <i class="fas fa-plus"></i> Nueva Vivienda
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="viviendaTable" class="table table-bordered table-hover table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center" data-order="asc">ID Vivienda</th>
                                    <th style="text-align: center">Nombre</th>
                                    <th style="text-align: center">Tipo de Casa</th>
                                    <th style="text-align: center">Tipo de Pago</th>
                                    <th style="text-align: center">Valor Pago</th>
                                    <th style="text-align: center">Dirección</th>
                                    <th style="text-align: center">Material</th>
                                    <th style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach(collect($viviendas)->sortBy(fn($p) => (int) $p['id_vivienda']) as $vivienda)
                                    <tr>
                                        <td style="text-align: center" data-order="asc">{{ $vivienda['id_vivienda'] }}</td>
                                        <td>{{ $vivienda['nombre_persona'] }}</td>
                                        <td>{{ $vivienda['tipo_casa'] }}</td>
                                        <td>{{ $vivienda['tipo_pago_vivienda'] ?? 'N/A' }}</td>
                                        <td style="text-align: center">{{ $vivienda['valor_pago'] ?? 'N/A' }}</td>
                                        <td>{{ $vivienda['direccion_completa'] }}</td>
                                        <td>{{ $vivienda['material_construccion'] }}</td>
                                        <td style="text-align: center">
                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm"
                                                onclick="viewModal({{ json_encode($vivienda) }})">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('viviendas.show', $vivienda['id_vivienda']) }}"
                                                class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('viviendas.destroy', $vivienda['id_vivienda']) }}"
                                                method="POST" class="d-inline delete-form">
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
                        <script>
function sortTable(columnIndex) {
    let table = document.getElementById("viviendaTable");
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
                        <h5 class="modal-title" id="viewModalLabel">Información de Solicitud</h5>
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



        <!-- Modal para Insertar Nueva Vivienda -->
        <div class="modal fade" id="insertVivienda" tabindex="-1" aria-labelledby="insertViviendaLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="insertViviendaLabel">Agregar Nueva Vivienda</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="insertViviendaForm" action="{{ route('viviendas.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <x-adminlte-select name="id_persona" label="Seleccionar Persona" fgroup-class="mb-3"
                                        required>
                                        <option value="">Seleccione una persona</option>
                                        @foreach ($personas as $persona)
                                            <option value="{{ $persona->id_persona }}">
                                                {{ $persona->nombres_apellidos }} - {{ $persona->n_identidad }}
                                            </option>
                                        @endforeach
                                    </x-adminlte-select>

                                    <x-adminlte-select name="tipo_casa" label="Tipo de Casa" fgroup-class="mb-3" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Alquila">Alquila</option>
                                        <option value="Propia">Propia</option>
                                        <option value="Familiar">Familiar</option>
                                    </x-adminlte-select>

                                    <x-adminlte-select name="pago_vivienda" label="Pago de Vivienda" fgroup-class="mb-3"
                                        required>
                                        <option value="">Seleccione...</option>
                                        <option value="SI">Sí</option>
                                        <option value="NO">No</option>
                                    </x-adminlte-select>

                                    <x-adminlte-select name="tipo_pago_vivienda" label="Tipo de Pago"
                                        fgroup-class="mb-3">
                                        <option value="">Seleccione...</option>
                                        <option value="Semanal">Semanal</option>
                                        <option value="Quincenal">Quincenal</option>
                                        <option value="Mensual">Mensual</option>
                                    </x-adminlte-select>

                                    <x-adminlte-input name="valor_pago" label="Valor del Pago" type="number"
                                        fgroup-class="mb-3" placeholder="Ingrese el monto" />

                                    
                                </div>
                                <div class="col-md-6">
                                    
                                   


                                    <x-adminlte-select name="tiempo_vivir" label="Tiempo de Vivir" fgroup-class="mb-3"
                                        required>
                                        <option value="">Seleccione...</option>
                                        <option value="1 año">1 año</option>
                                        <option value="2 años">2 años</option>
                                        <option value="3 años">3 años</option>
                                        <option value="4 años">4 años</option>
                                        <option value="Más de 5 años">Más de 5 años</option>
                                    </x-adminlte-select>

                                    

                                    <x-adminlte-select name="material_construccion" label="Material de Construcción"
                                        fgroup-class="mb-3" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Concreto">Concreto</option>
                                        <option value="Madera">Madera</option>
                                        <option value="Mixto">Mixto</option>
                                         <option value="Concreto">Adobe</option>
                                        <option value="Madera">Ladrillo</option>
                                        <option value="Mixto">Bloque</option>
                                    </x-adminlte-select>

                                    <x-adminlte-input name="dependiente" label="Dependiente" type="number"
                                        fgroup-class="mb-3" placeholder="Ingrese la cantidad de dependientes"
                                        min="1" max="10" id="dependiente" required />
                                    @push('js')
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                document.getElementById("dependiente").addEventListener("input", function() {
                                                    let value = parseInt(this.value);
                                                    if (value < 1) this.value = 1;
                                                    if (value > 10) this.value = 10;
                                                });
                                            });
                                        </script>
                                    @endpush
                                    
                                    <x-adminlte-textarea name="direccion_completa" label="Dirección Completa"
                                    fgroup-class="mb-3" placeholder="Ingrese la dirección" required/>


                                   
                                </div>
                            </div>

                            <div class="modal-footer">
                                <x-adminlte-button label="Cancelar" data-bs-dismiss="modal" class="btn-secondary" />
                                <x-adminlte-button class="btn-flat" type="submit" label="Guardar Vivienda"
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
                $('#viviendaTable').DataTable({ // Inicializa DataTables en tu tabla "relacionTable"
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
   

            function viewModal(vivienda) {
                var modalBody = document.getElementById('viewModalBody');
                modalBody.innerHTML = `
        <div class="col-md-6">
            <p><strong>Nombre del Solicitante:</strong> ${vivienda.nombre_persona}</p>
            <p><strong>Dependientes:</strong> ${vivienda.dependiente || 'No disponible'}</p>
            <p><strong>Tipo de Casa:</strong> ${vivienda.tipo_casa}</p>
            <p><strong>Tiempo Viviendo:</strong> ${vivienda.tiempo_vivir}</p>
            <p><strong>Pago de Vivienda:</strong> ${vivienda.pago_vivienda || 'No disponible'}</p>
             <p><strong>Tipo de Pago:</strong> ${vivienda.tipo_pago_vivienda || 'No disponible'}</p>
            <p><strong>Valor del Pago:</strong> ${vivienda.valor_pago ? vivienda.valor_pago + ' Lps' : 'No disponible'}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Dirección Completa:</strong> ${vivienda.direccion_completa || 'No disponible'}</p>
            <p><strong>Material de Construcción:</strong> ${vivienda.material_construccion}</p>
            <p><strong>Creado por:</strong> ${vivienda.creado_por} value="{{ auth()->user()->id }} </p>
            <p><strong>Creado en:</strong> ${vivienda.creado_en ? new Date(vivienda.creado_en).toLocaleString() : 'No disponible'}</p>
            <p><strong>Modificado por:</strong> ${vivienda.modificado_por || 'No disponible'}</p>
            <p><strong>Modificado en:</strong> ${vivienda.modificado_en ? new Date(vivienda.modificado_en).toLocaleString() : 'No disponible'}</p>
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



        <script>
    document.addEventListener("DOMContentLoaded", function () {
        const pagoVivienda = document.querySelector('select[name="pago_vivienda"]');
        const tipoPago = document.querySelector('select[name="tipo_pago_vivienda"]');
        const valorPago = document.querySelector('input[name="valor_pago"]');

        function toggleRequiredFields() {
            if (pagoVivienda.value === 'SI') {
                tipoPago.setAttribute('required', 'required');
                valorPago.setAttribute('required', 'required');
            } else {
                tipoPago.removeAttribute('required');
                valorPago.removeAttribute('required');
            }
        }

        // Ejecutar al cargar
        toggleRequiredFields();

        // Ejecutar al cambiar
        pagoVivienda.addEventListener('change', toggleRequiredFields);
    });
</script>


    @stop
