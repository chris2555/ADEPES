@extends('layout.app')


@section('subtitle', 'Pagos')

@section('content_header')
<h1><b>Listado de Pagos</b></h1>
    <hr>
@stop

@section('content_body')
<style>
    .subrow.expanded {
  background-color: #cce5ff; /* azul claro */
}
.subrow {
    background-color: #e6f2ff; /* azul claro */
}


</style>
<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">
                        @hasanyrole(['Administrador', 'Contador'])
                            <div class="card-header">
                                <h3 class="card-title">DETALLE DE PAGOS</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertPago">
                                        <i class="fas fa-plus"></i> Nuevo Pago
                                    </button>
                                </div>
                            </div>
                        @endhasanyrole


            <div class="card-body">
                <div class="table-responsive">
                    <table id="pagoTable" class="table table-bordered table-hover  table-sm">
                        <thead>
                            <tr>
                                <th style="text-align: center">Fecha</th>
                                <th style="text-align: center">Correlativo</th>
                                <th style="text-align: center">Nombre Cliente</th>
                                <th style="text-align: center">Monto Préstamo</th>
                                <th style="text-align: center">Cuota</th>
                                <th style="text-align: center">Intereses</th>
                                <th style="text-align: center">Abono a Capital</th>
                                <th style="text-align: center">Excedente/Déficit</th>
                                <th style="text-align: center">Resumen de Pagos</th>
                                <th style="text-align: center">Recibos de pago</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        @php
    // Obtener plazos por préstamo desde la API externa
    $plazosPorPrestamo = [];

    try {
        $prestamosApi = json_decode(file_get_contents('https://goldfish-app-q3ucp.ondigitalocean.app/api/prestamo'), true);

        foreach ($prestamosApi as $prestamo) {
            if (isset($prestamo['id_prestamo']) && isset($prestamo['plazo'])) {
                $plazosPorPrestamo[$prestamo['id_prestamo']] = $prestamo['plazo'];
            }
        }
    } catch (\Exception $e) {
        $plazosPorPrestamo = [];
    }

    // Agrupar pagos por nombre completo del cliente
    $pagosAgrupados = collect($pagos)->groupBy('nombres_apellidos');
@endphp

<tbody>
@foreach ($pagosAgrupados as $nombre => $grupo)
    @php
        $primerPago = $grupo->first();
        $plazo = $plazosPorPrestamo[$primerPago['id_prestamo']] ?? 'N/A';
    @endphp

    <tr data-nombre="{{ $nombre }}">
        <td style="text-align: center">{{ date('d-m-Y', strtotime($primerPago['fecha'])) }}</td>
        <td style="text-align: center">1/{{ $plazo }}</td>
        <td>{{ $primerPago['nombres_apellidos'] }}</td>
        <td style="text-align: center">{{ $primerPago['monto_prestamo'] }}</td>
        <td style="text-align: center">{{ $primerPago['monto'] }}</td>
        <td style="text-align: center">{{ $primerPago['intereses'] }}</td>
        <td style="text-align: center">{{ $primerPago['abono_capital'] }}</td>
        <td style="text-align: center">{{ $primerPago['estado'] }}</td>
        <td style="text-align: center">
            <a href="{{ route('pagado', $primerPago['id_persona']) }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-file-alt"> Pagos Realizados </i>
            </a>
        </td>
        <td style="text-align: center">
            @role('Tecnico')
                <button type="button" class="btn btn-outline-primary btn-sm" onclick="Swal.fire({
                    icon: 'warning',
                    title: 'Acceso restringido',
                    text: 'No tienes permisos para ver el recibo de pago.',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#28a745'
                })">
                    <i class="fas fa-file-alt"></i> Recibo de pago
                </button>
            @endrole

            @hasanyrole('Administrador|Contador')
                <a href="{{ route('recibo', [$primerPago['id_persona'], $primerPago['id_pago']]) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-file-alt"></i> Recibo de pago
                </a>
            @endhasanyrole
        </td>

        <td style="text-align: center">
            <button class="btn btn-info btn-sm toggle-subrows"><i class="bi bi-plus-lg"></i></button>
            <a href="javascript:void(0);" class="btn btn-primary btn-sm"
                onclick="viewModal({{ json_encode($primerPago) }})">
                <i class="bi bi-eye"></i>
            </a>
                <a href="#" 
                class="btn btn-success btn-sm pago-confirmation"
                data-id="{{ $primerPago['id_pago'] }}"
                data-rol="{{ Auth::user()->getRoleNames()->first() }}">
                    <i class="bi bi-pencil"></i>
                </a>

                @role('Tecnico')
                    <button type="button"
                            class="btn btn-danger btn-sm"
                            onclick="Swal.fire({
                                icon: 'warning',
                                title: 'Acceso restringido',
                                text: 'No se puede eliminar un pago aprobado.',
                                confirmButtonText: 'Entendido',
                                confirmButtonColor: '#28a745'
                            })">
                        <i class="bi bi-trash"></i>
                    </button>
                @endrole

                @hasanyrole('Administrador')
                    <form action="{{ route('pagos.destroy', $primerPago['id_pago']) }}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                @endhasanyrole

            </form>
        </td>
    </tr>

   {{-- Subfilas ocultas --}}

@foreach ($grupo->skip(1)->values() as $i => $subPago)
    @php
        $plazo = $plazosPorPrestamo[$subPago['id_prestamo']] ?? 'N/A';
    @endphp
    <tr class="subrow" data-parent="{{ $nombre }}" style="display: none;">
        <td style="text-align: center">{{ date('d-m-Y', strtotime($subPago['fecha'])) }}</td>
        <td style="text-align: center">{{ $i + 2 }}/{{ $plazo }}</td>
        <td>{{ $subPago['nombres_apellidos'] }}</td>
        <td style="text-align: center">{{ $subPago['monto_prestamo'] }}</td>
        <td style="text-align: center">{{ $subPago['monto'] }}</td>
        <td style="text-align: center">{{ $subPago['intereses'] }}</td>
        <td style="text-align: center">{{ $subPago['abono_capital'] }}</td>
        <td style="text-align: center">{{ $subPago['estado'] }}</td>
        <td></td> <!-- Celda vacía donde iría Pagos Realizados -->
        <td style="text-align: center">
            @role('Tecnico')
                <button type="button" class="btn btn-outline-primary btn-sm" onclick="Swal.fire({
                    icon: 'warning',
                    title: 'Acceso restringido',
                    text: 'No tienes permisos para ver el recibo de pago.',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#28a745'
                })">
                    <i class="fas fa-file-alt"></i> Recibo de pago
                </button>
            @endrole

            @hasanyrole('Administrador|Contador')
                <a href="{{ route('recibo', [$subPago['id_persona'], $subPago['id_pago']]) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-file-alt"></i> Recibo de pago
                </a>
            @endhasanyrole
        </td>

        <td style="text-align: center">
    <a href="javascript:void(0);" class="btn btn-primary btn-sm"
        onclick="viewModal({{ json_encode($subPago) }})">
        <i class="bi bi-eye"></i>
    </a>

    @hasanyrole(['Administrador', 'Contador', 'Tecnico'])
        <a href="{{ route('pagos.show', $subPago['id_pago']) }}"
        class="btn btn-success btn-sm pago-confirmation"
        data-id="{{ $subPago['id_pago'] }}"
        data-rol="{{ Auth::user()->getRoleNames()->first() }}">
            <i class="bi bi-pencil"></i>
        </a>
    @endhasanyrole

    @role('Tecnico')
        <button type="button"
                class="btn btn-danger btn-sm"
                onclick="Swal.fire({
                    icon: 'warning',
                    title: 'Acceso restringido',
                    text: 'No se puede eliminar un pago aprobado.',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#28a745'
                })">
            <i class="bi bi-trash"></i>
        </button>
    @endrole

    @hasanyrole('Administrador')
        <form action="{{ route('pagos.destroy', $subPago['id_pago']) }}" method="POST" class="d-inline delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    @endhasanyrole
</td>

    </tr>
@endforeach

@endforeach
</tbody>


                    </table>
@stop
    
    
<!-- Modal para Insertar Nuevo Pago -->
<div class="modal fade" id="insertPago" tabindex="-1" aria-labelledby="insertPagoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertPagoLabel">Agregar Nuevo Pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pagos.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                           
                            <x-adminlte-select name="id_prestamo" label="Seleccionar Préstamo" fgroup-class="mb-3" required>
                                <option value="">Seleccione un préstamo</option>
                                @foreach ($prestamos as $prestamo)
                                    <option value="{{ $prestamo['id_prestamo'] }}">
                                        {{ $prestamo['id_prestamo'] }} - {{ $prestamo['nombres_apellidos'] }} - L.{{ number_format($prestamo['monto'], 2) }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                            
                            
                            <x-adminlte-select name="id_persona" label="Seleccionar Persona" fgroup-class="mb-3" required>
                                <option value="">Seleccione una persona</option>
                                @foreach ($personas as $persona)
                                    <option value="{{ $persona->id_persona }}">
                                        {{ $persona->nombres_apellidos }} - {{ $persona->n_identidad }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                            
                            <x-adminlte-input name="monto" label="Monto del Pago" type="number" step="0.01" min="0" fgroup-class="mb-3" placeholder="Ingrese el monto" required />

                            <x-adminlte-select name="metodo_pago" label="Método de Pago" fgroup-class="mb-3" required>
                                <option value="">Seleccione...</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Cheque">Cheque</option>
                            </x-adminlte-select>

                            <x-adminlte-input name="recibo" label="Número de Recibo" type="text" fgroup-class="mb-3" placeholder="Ingrese el número de recibo"  />
                        </div>

                        <div class="col-md-6">
                        <x-adminlte-input name="fecha" label="Fecha de Pago" type="date" fgroup-class="mb-3" required />


                            <x-adminlte-input name="intereses" label="Intereses" type="number" step="0.01" min="0" fgroup-class="mb-3" placeholder="Ingrese el monto de intereses"  required />
                            <x-adminlte-input name="abono_capital" label="Abono Capital" type="number" fgroup-class="mb-3" readonly /> 
                        </div>
                    </div>

                    <div class="modal-footer">
                        <x-adminlte-button label="Cancelar" data-bs-dismiss="modal" class="btn btn-secondary text-white bg-secondary border-0" />
                        <x-adminlte-button class="btn-flat" type="submit" label="Guardar Pago" theme="success" icon="fas fa-lg fa-save" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



    {{-- Modal para Ver Información de pagos --}}
    <div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Información del Pago</h5>
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

    @section('js')
    
    <script>
  document.addEventListener('DOMContentLoaded', function () {
    const montoPagoInput = document.querySelector('#monto_pago');
    const interesInput = document.querySelector('#intereses');
    const capitalInput = document.querySelector('#abono_capital');
    const prestamoSelect = document.querySelector('#id_prestamo');

    let interesMensual = 0;

    // Consultar interés estimado al seleccionar préstamo
    prestamoSelect.addEventListener('change', async function () {
      const idPrestamo = this.value;

      if (!idPrestamo) return;

      try {
        const res = await fetch(`/api/interes-mensual/${idPrestamo}`);
        const data = await res.json();
        interesMensual = parseFloat(data.interes_mensual || 0);
        interesInput.value = interesMensual.toFixed(2);
        actualizarCapital();
      } catch (error) {
        console.error('Error obteniendo interés:', error);
      }
    });

    // Al escribir el monto, recalcular capital
    montoPagoInput.addEventListener('input', actualizarCapital);

    function actualizarCapital() {
      const pago = parseFloat(montoPagoInput.value || 0);
      let abonoInteres = 0;
      let abonoCapital = 0;

      if (pago >= interesMensual) {
        abonoInteres = interesMensual;
        abonoCapital = pago - interesMensual;
      } else {
        abonoInteres = pago;
        abonoCapital = 0;
      }

      interesInput.value = abonoInteres.toFixed(2);
      capitalInput.value = abonoCapital.toFixed(2);
    }
  });
</script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Campos relevantes
        const montoField = document.querySelector('input[name="monto"]');
        const interesesField = document.querySelector('input[name="intereses"]');
        const abonoCapitalField = document.querySelector('input[name="abono_capital"]');

        function calculateAbonoCapital() {
            // Convertir valores a números y validar
            const monto = parseFloat(montoField.value) || 0; // Monto del pago
            const intereses = parseFloat(interesesField.value) || 0; // Intereses

            // Calcular abono capital
            const abonoCapital = monto - intereses;

            // Mostrar resultado (asegurarse de que no sea negativo)
            abonoCapitalField.value = abonoCapital > 0 ? abonoCapital.toFixed(2) : 0.00;
        }

        // Escuchar cambios en los campos monto e intereses
        [montoField, interesesField].forEach(field => {
            field.addEventListener('input', calculateAbonoCapital);
        });

        // Ejecutar cálculo inicial si hay valores preestablecidos
        calculateAbonoCapital();
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const pagoButtons = document.querySelectorAll('.pago-confirmation');

    pagoButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const pagoId = this.dataset.id;
            const rol = this.dataset.rol;

            if (rol === 'Tecnico') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Acceso restringido',
                    text: 'No puedes editar un pago aprobado.',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#28a745'
                });
            } else {
                // Redirige a la página del pago si el rol no es Técnico
                window.location.href = `/pagos/${pagoId}`;
            }
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const pagoButtons = document.querySelectorAll('.pago-confirmation');

    pagoButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const pagoId = this.dataset.id;
            const rol = this.dataset.rol;

            if (rol === 'Tecnico') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Acceso restringido',
                    text: 'No puedes editar un pago aprobado.',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#28a745'
                });
            } else {
                // Redirige a la página del pago si el rol no es Técnico
                window.location.href = `/pagos/${pagoId}`;
            }
        });
    });
});
</script>




<script src="//cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/luxon@3.3.0/build/global/luxon.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function () {
        $('#pagoTable').DataTable({
            "order": [],
            "pageLength": 25,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "language": {
                "search": "Buscador:",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "infoFiltered": "(Filtrado de _MAX_ total de entradas)",
                "lengthMenu": "Mostrar _MENU_ Registros",
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


    function viewModal(pagos) {
    var DateTime = luxon.DateTime;
    var fechaFormateada = DateTime.fromISO(pagos.fecha, { zone: 'utc' })
        .setLocale('es')
        .toFormat("dd 'de' MMMM 'de' yyyy");

    var modalBody = document.getElementById('viewModalBody');
    modalBody.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <p><strong>ID Pago:</strong> ${pagos.id_pago}</p>
                <p><strong>ID Préstamo:</strong> ${pagos.id_prestamo}</p>
                <p><strong>Monto del Préstamo:</strong> ${pagos.monto_prestamo}</p>
                <p><strong>ID Persona:</strong> ${pagos.id_persona}</p>
                <p><strong>Nombre del Cliente:</strong> ${pagos.nombres_apellidos}</p>
                <p><strong>Método de Pago:</strong> ${pagos.metodo_pago}</p>
                <p><strong>Recibo:</strong> ${pagos.recibo}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Monto Pagado:</strong> ${pagos.monto}</p>
                <p><strong>Fecha de Pago:</strong> ${fechaFormateada}</p>
                <p><strong>Intereses:</strong> ${pagos.intereses}</p>
                <p><strong>Creado por:</strong> ${pagos.nombre_creador ?? 'No disponible'}</p>
                <p><strong>Creado en:</strong> ${pagos.creado_en ? new Date(pagos.creado_en).toLocaleString() : 'No disponible'}</p>
                <p><strong>Modificado por:</strong> ${pagos.nombre_modificador ?? 'No disponible'}</p>
                <p><strong>Modificado en:</strong> ${pagos.modificado_en ? new Date(pagos.modificado_en).toLocaleString() : 'No disponible'}</p>
            </div>
        </div>
    `;

    var viewModalElement = new bootstrap.Modal(document.getElementById('view'));
    viewModalElement.show();
}



document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function (event) {
            const rol = this.dataset.rol;

            if (rol === 'Tecnico') {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Acceso restringido',
                    text: 'No tienes permisos para eliminar este pago.',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#28a745'
                });
                return;
            }

            // Confirmación para otros roles
            event.preventDefault();
            const form = this.closest("form");

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
                    form.submit();
                }
            });
        });
    });
});
</script>





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


<script>
document.addEventListener('DOMContentLoaded', function () {
    // Código que ya tienes para toggle-subrows:
    const botones = document.querySelectorAll('.toggle-subrows');

    botones.forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const nombre = row.getAttribute('data-nombre');
            const subrows = document.querySelectorAll(`.subrow[data-parent="${nombre}"]`);
            const isVisible = subrows[0]?.style.display !== 'none';

            // Cerrar todas las filas expandidas
            document.querySelectorAll('.subrow').forEach(sub => {
                sub.style.display = 'none';
                sub.classList.remove('expanded');
            });

            // Cambiar íconos de todos los botones
            document.querySelectorAll('.toggle-subrows i').forEach(icon => {
                icon.classList.remove('bi-dash-lg');
                icon.classList.add('bi-plus-lg');
            });

            // Si no estaban visibles, mostrar solo las de este grupo
            if (!isVisible) {
                subrows.forEach(sub => {
                    sub.style.display = '';
                    sub.classList.add('expanded');
                });

                // Cambiar ícono del botón actual
                this.querySelector('i').classList.remove('bi-plus-lg');
                this.querySelector('i').classList.add('bi-dash-lg');
            }
        });
    });
});
</script>

<script>
$(document).ready(function () {
    const table = $('#pagoTable').DataTable();

    // Evento: cuando se hace búsqueda, ocultar las subfilas
    table.on('search.dt', function () {
        $('.subrow').hide().removeClass('expanded');
        $('.toggle-subrows i').removeClass('bi-dash-lg').addClass('bi-plus-lg');
    });
});
</script>


@stop

