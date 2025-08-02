@extends('adminlte::page')

@section('title', 'Solicitud')

@section('content_header')
<h1><b>Listado de Solicitud de prestamo</b></h1>
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
            <h3 class="card-title">GESTION DE SOLICITUD</h3>
            <div class="card-tools">
                @hasanyrole(['Tecnico', 'Administrador'])
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert">
                    <i class="fas fa-plus"></i> Nueva Solicitud
                </button>
                @endhasanyrole
                </div>
                </div>

                <div class="card-body">
                <div class="table-responsive">
                    <table id="relacionTable" class="table table-bordered table-hover table-striped table-sm">
                        <thead>
                            <tr>
                                <th style="text-align: center" data-order="asc">ID Solicitud</th>
                                <th style="text-align: center">ID persona</th>
                                <th style="text-align: center">Nombre Solicitante</th>
                                <th style="text-align: center">Garantia</th>
                                <th style="text-align: center">Cuota</th>
                                <th style="text-align: center">Tasa</th>
                                <th style="text-align: center">Plazo</th>
                                <th style="text-align: center">Monto</th>
                                <th style="text-align: center">Estado</th>
                                <th style="text-align: center">Amortizacion</th>
                                <th style="text-align: center">Dictamen</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach(collect($solicitudes)
                            ->sortBy(fn($p) => (int) $p['id_solicitud'])
                            ->filter(function ($solicitud) {
                                if (auth()->user()->hasAnyRole(['Tecnico', 'Administrador'])) {
                                    return true; // Pueden ver todos los estados
                                }

                                if (auth()->user()->hasRole('Contador')) {
                                    return $solicitud['estado_solicitud'] === 'Aprobado'; // Solo ve "Aprobado"
                                }

                                return false; // Otros roles no ven nada
                            }) as $solicitud)

                                <tr>
                                    <td style="text-align: center" data-order="asc">{{ $solicitud['id_solicitud'] }}</td>
                                    <td style="text-align: center">{{ $solicitud['id_persona'] }}</td>
                                    <td>{{ $solicitud['nombre_solicitante'] }}</td>
                                    <td style="text-align: center">{{ $solicitud['tipo_garantia'] }}</td>
                                    <td style="text-align: center">{{ $solicitud['tipo_cuota'] }}</td>
                                    <td style="text-align: center">{{ $solicitud['tasa'] }}</td>
                                    <td style="text-align: center">{{ $solicitud['plazo'] }}</td>
                                    <td style="text-align: center">{{ $solicitud['monto'] }}</td>
                                    <td style="text-align: center"> 
                            @php
                         $estado = $solicitud['estado_solicitud'];
                            $claseEstado = match ($estado) {
                            'Aprobado' => 'badge bg-success',
                            'Pendiente' => 'badge bg-primary',
                            'Rechazado' => 'badge bg-danger',
                            default => 'badge bg-secondary',
                             };
                         @endphp

                                        <span class="{{ $claseEstado }}" style="font-size: 0.975rem;">{{ $estado }}</span>
                                    </td>
                                    <td style="text-align: center">
                                    @if($solicitud['estado_solicitud'] === 'Aprobado')
                                        <a href="{{ route('amortizacion', $solicitud['id_solicitud']) }}" class="btn btn-outline-primary btn-sm" title="Ver Tabla de Amortización">
                                        <i class="fas fa-file-alt"> Tabla de amortizacion </i>

                                        </a>
                                    @else
                                        <span class="text-muted">No disponible</span>
                                    @endif
                                    </td>


                       {{-- Columna Dictamen --}}
<td style="text-align: center">
    @if($solicitud['estado_solicitud'] === 'Pendiente')
        <a href="{{ route('dictamen', $solicitud['id_solicitud']) }}"
            class="btn btn-outline-primary btn-sm" title="Generar dictamen PDF">
            <i class="fas fa-file-pdf"></i> Dictamen
        </a>
    @else
        <span class="text-muted">No disponible</span>
    @endif
</td>

{{-- Columna Acciones --}}
<td style="text-align: center">
    @hasanyrole(['Tecnico', 'Administrador', 'Contador'])
        <a href="javascript:void(0);" class="btn btn-primary btn-sm"
            onclick="viewModal({{ json_encode($solicitud) }})">
            <i class="bi bi-eye"></i>
        </a>
    @endhasanyrole

    @php
        $mostrarBoton = in_array($solicitud['estado_solicitud'], ['Aprobado', 'Pendiente', 'Rechazado']) || 
                        Auth::user()->hasRole(['Administrador', 'Tecnico', 'Contador']);
    @endphp

    @if($mostrarBoton)
        @hasanyrole(['Tecnico', 'Contador', 'Administrador'])
            <a href="#" 
                class="btn btn-success btn-sm show-confirmation" 
                data-id="{{ $solicitud['id_solicitud'] }}"
                data-estado="{{ $solicitud['estado_solicitud'] }}">
                <i class="bi bi-pencil"></i>
            </a>
        @endhasanyrole
    @endif

    @hasanyrole(['Administrador', 'Tecnico'])
        @if(in_array($solicitud['estado_solicitud'], ['Rechazado', 'Pendiente']) || Auth::user()->hasRole('Administrador'))
            <form action="{{ route('solicitudes.destroy', $solicitud['id_solicitud']) }}"
                method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm delete-btn" data-estado="{{ $solicitud['estado_solicitud'] }}">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        @endif
    @endhasanyrole
</td>
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



    {{-- Modal para Insertar Nueva Solicitud --}}
    <div class="modal fade" id="insert" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertModalLabel">Insertar Nueva Solicitud</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insertForm" action="{{ route('solicitudes.store') }}" method="POST" onsubmit="return validarFormulario(event)">
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

                                <x-adminlte-select name="tipo_garantia" label="Seleccionar Tipo de Garantía"
                                    fgroup-class="mb-3" required>
                                    <option value="">Seleccione una garantía</option>
                                    <option value="Fiduciaria">Fiduciaria</option>
                                    <option value="Prendaria">Prendaria</option>
                                    <option value="Hipotecaria">Hipotecaria</option>
                                    <option value="Solidaria">Solidaria</option>
                                </x-adminlte-select>

                                <x-adminlte-select name="tipo_cuota" label="Seleccionar Tipo de Cuota" fgroup-class="mb-3"
                                    required>
                                    <option value="">Seleccione una Cuota</option>
                                    <option value="Nivelada">Nivelada</option>
                                    <option value="Variable">Variable</option>

                                </x-adminlte-select>

                                <x-adminlte-select name="tasa" label="Seleccionar Tasa de Interés" fgroup-class="mb-3"
                                    required>
                                    <option value="">Seleccione una tasa</option>
                                    @for ($tasa = 1.0; $tasa <= 12.0; $tasa += 1.0)
                                        <option value="{{ number_format($tasa, 2) }}">{{ number_format($tasa, 2) }}%
                                        </option>
                                    @endfor
                                </x-adminlte-select>

                                <x-adminlte-select name="plazo" label="Seleccionar Plazo (Meses)" fgroup-class="mb-3"
                                    required>
                                    <option value="">Seleccione un plazo</option>
                                    @for ($plazo = 12; $plazo <= 48; $plazo += 12)
                                        <option value="{{ $plazo }}">{{ $plazo }} meses</option>
                                    @endfor
                                </x-adminlte-select>

                                <x-adminlte-input name="monto" type="number" label="Monto del Préstamo"
                                    placeholder="Ingrese el monto" fgroup-class="mb-3" step="0.01" min="10000"
                                    max="60000" required />
                                    <x-adminlte-input name="finalidad_cre" type="text" label="Finalidad del Crédito"
                                    placeholder="Ej. Compra de insumos, expansión de negocio..." fgroup-class="mb-3"
                                    maxlength="50" required
                                    pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+\.?$"
                                    title="Solo letras, espacios y un punto final opcional. No se permiten números ni signos especiales." />
                            </div>
                            <div class="col-md-6">
                                <x-adminlte-select name="invierte_en" label="Sector de Inversión" fgroup-class="mb-3"
                                    required>
                                    <option value="">Seleccione un sector</option>
                                    <option value="Comercio">Comercio</option>
                                    <option value="Industria">Industria</option>
                                    <option value="Servicios">Servicios</option>
                                    <option value="Agropecuario">Agropecuario</option>
                                </x-adminlte-select>

                                <x-adminlte-select name="tipo_credito" label="Tipo de Crédito" fgroup-class="mb-3"
                                    required>
                                    <option value="">Seleccione un tipo de crédito</option>
                                    <option value="Reingreso">Reingreso</option>
                                    <option value="Refinanciamiento">Refinanciamiento</option>
                                    <option value="Novacion">Novación</option>
                                    <option value="Primera Vez">Primera Vez</option>
                                </x-adminlte-select>

                                <x-adminlte-select name="estado_solicitud" label="Estado de la Solicitud"
                                    fgroup-class="mb-3">
                                    <option value="">Seleccione el estado</option>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="Aprobado">Aprobado</option>
                                    <option value="Rechazado">Rechazado</option>
                                </x-adminlte-select>

                                <x-adminlte-input name="valor_cuota" type="number" label="Valor de la Cuota"
                                    placeholder="Ingresa el valor de la cuota" fgroup-class="mb-3" step="0.01"
                                    min="0" required />

                                <x-adminlte-input name="capital" type="number" label="Valor del capital"
                                    placeholder="" fgroup-class="mb-3" step="0.01"
                                    min="0" required />
                                    
                                    <x-adminlte-input name="interes" type="number" label="Valor del interes"
                                    placeholder="" fgroup-class="mb-3" step="0.01"
                                    min="0" required />

                                    <x-adminlte-select name="es_aval" label="Tipo de Aval" fgroup-class="mb-3" required>
                                    <option value="">Seleccione el tipo de aval</option>
                                    <option value="No es aval">No es aval</option>
                                    <option value="Avala 1 persona">Avala 1 persona</option>
                                    <option value="Avala 2 personas">Avala 2 personas</option>
                                    <option value="Avala mas de 2 personas">Avala más de 2 personas</option>
                                </x-adminlte-select>

                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <x-adminlte-button label="Cancelar" data-bs-dismiss="modal" class="btn-secondary" />
                            <x-adminlte-button class="btn-flat" type="submit" id="btnGuardar" label="Guardar Relación"
                                theme="success" icon="fas fa-lg fa-save" />
                        </div>
                        </form>
                </div>
        </div>
    </div>
</div>

<script>
    function viewModal(solicitud) {
        document.getElementById('capital').innerText = 'L ' + solicitud.monto.toLocaleString('es-HN', { minimumFractionDigits: 2 });
        let interesCalculado = (solicitud.monto * solicitud.tasa / 100) * solicitud.plazo;
        document.getElementById('interes').innerText = 'L ' + interesCalculado.toFixed(2).toLocaleString('es-HN');
        new bootstrap.Modal(document.getElementById('view')).show();
    }
</script>

    


    <script>
    document.addEventListener("DOMContentLoaded", function () {
    const tipoCuota = document.querySelector("select[name='tipo_cuota']");
    const tasa = document.querySelector("select[name='tasa']");
    const plazo = document.querySelector("select[name='plazo']");
    const monto = document.querySelector("input[name='monto']");
    const valorCuota = document.querySelector("input[name='valor_cuota']");
    const capital = document.querySelector("input[name='capital']");
    const interes = document.querySelector("input[name='interes']");

    function calcularCuota() {
        const tipo = tipoCuota.value;
        const tasaInteres = parseFloat(tasa.value) / 100;
        const plazoMeses = parseInt(plazo.value);
        let montoPrestamo = parseFloat(monto.value);

        if (!tipo || isNaN(tasaInteres) || isNaN(plazoMeses) || isNaN(montoPrestamo)) {
            valorCuota.value = "";
            capital.value = "";
            interes.value = "";
            return;
        }

        let cuotaFija, interesMensual, capitalMensual;
        
        if (tipo === "Nivelada") {
            const r = tasaInteres / 12;
            cuotaFija = (montoPrestamo * r * Math.pow(1 + r, plazoMeses)) / (Math.pow(1 + r, plazoMeses) - 1);
            
            interesMensual = montoPrestamo * r;
            capitalMensual = cuotaFija - interesMensual;
        } else {
            interesMensual = (montoPrestamo * tasaInteres / 12);
            capitalMensual = montoPrestamo / plazoMeses;
            cuotaFija = interesMensual + capitalMensual;
        }

        valorCuota.value = cuotaFija.toFixed(2);
        capital.value = capitalMensual.toFixed(2);
        interes.value = interesMensual.toFixed(2);
    }

    tipoCuota.addEventListener("change", calcularCuota);
    tasa.addEventListener("change", calcularCuota);
    plazo.addEventListener("change", calcularCuota);
    monto.addEventListener("input", calcularCuota);
});
    </script>


<script>
function validarFormulario(event) {
    const valorCuota = document.querySelector("input[name='valor_cuota']");
    const capital = document.querySelector("input[name='capital']");
    const interes = document.querySelector("input[name='interes']");

    const camposNumericos = [
        { campo: valorCuota, nombre: "Valor de la Cuota" },
        { campo: capital, nombre: "Valor del Capital" },
        { campo: interes, nombre: "Valor del Interés" }
    ];

    for (let { campo, nombre } of camposNumericos) {
        const valor = campo.value.trim();
        if (!/^\d+(\.\d{1,2})?$/.test(valor)) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Dato inválido',
                text: `El campo "${nombre}" solo admite números válidos.`,
                confirmButtonColor: '#d33'
            });
            campo.focus();
            return false;
        }
    }

    return true;
}
</script>


<!-- Inyecta el rol del usuario como atributo en el body -->
<body data-rol="{{ Auth::user()->rol }}"> <!-- Laravel Blade ejemplo -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.show-confirmation');
        const userRole = document.body.dataset.rol; // 'Administrador' o 'Tecnico'

        editButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const solicitudId = this.dataset.id;
                const estado = this.dataset.estado;

                // Si el usuario es Técnico, bloquea la edición con una alerta
                if (userRole === 'Tecnico') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Acción no permitida',
                        text: 'No puede editar esta solicitud aprobada.',
                        confirmButtonText: 'Entendido',
                        confirmButtonColor: '#28a745'
                    });
                } else {
                    // Si es Administrador, continúa normalmente
                    window.location.href = `/solicitudes/${solicitudId}`;
                }
            });
        });
    });
</script>
</body>



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
            <p><strong>id del Solicitante:</strong> ${solicitud.id_solicitud}</p>
             <p><strong>id del Solicitante:</strong> ${solicitud.nombre_solicitante}</p>
            <p><strong>Tipo Garantia:</strong> ${solicitud.tipo_garantia || 'No disponible'}</p>
            <p><strong>Tipo de cuota:</strong> ${solicitud.tipo_cuota}</p>
            <p><strong>Tasa:</strong> ${solicitud.tasa}</p>
            <p><strong>Plazo:</strong> ${solicitud.plazo || 'No disponible'}</p>
            <p><strong>Monto:</strong> ${solicitud.monto || 'No disponible'}</p>
             <p><strong>Estado de la Solicitud:</strong> ${solicitud.estado_solicitud || 'No disponible'}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Valor de la Cuota:</strong> ${solicitud.valor_cuota || 'No disponible'}</p>
             <p><strong>Es Aval:</strong> ${solicitud.es_aval || 'No disponible'}</p>
             <p><strong>Finalidad Del Credito:</strong> ${solicitud.finalidad_cre || 'No disponible'}</p>
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
    //Alerta del boton Eliminar con condicion Aprobado
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            let form = this.closest("form");
            let estado = this.dataset.estado;

            if (estado === 'Aprobado') {
                Swal.fire({
                    icon: 'error',
                    title: 'No se puede eliminar',
                    text: 'La solicitud ya fue aprobada y no puede ser eliminada.',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#28a745' // color del boton
                });
            } else {
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
            }
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

