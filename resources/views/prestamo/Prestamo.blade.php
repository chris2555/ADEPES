@extends('adminlte::page')

@section('title', 'Gestión de Prestamos')

@section('content_header')
<h1><b>Listado de Prestamos</b></h1>
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
                <h3 class="card-title">Gestión de Prestamos</h3>
                <div class="card-tools">
                </div>
            </div>

            <div class="card-body">
                        <div class="table-responsive">
            <table id="prestamoTable" class="table table-bordered table-hover table-striped table-sm">
                <thead>
                    <tr>
                        <th style="text-align: center">ID</th>
                        <th style="text-align: center">Cliente</th>
                        <th style="text-align: center">DNI</th>
                        <th style="text-align: center">Monto</th>
                        <th style="text-align: center">Interés</th>
                        <th style="text-align: center">Plazo</th>
                        <th style="text-align: center">Estado</th>
                        <th style="text-align: center">Tipo</th>
                        <th style="text-align: center">Garantia</th>
                        <th style="text-align: center">Fecha Inicio</th>
                        <th style="text-align: center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @if(isset($prestamos) && is_array($prestamos) && count($prestamos) > 0)
    @foreach($prestamos as $prestamo)
        <tr>
            <td style="text-align: center">{{ $prestamo['id_prestamo'] ?? 'N/A' }}</td>
            <td>{{ $prestamo['nombres_apellidos'] ?? 'N/A' }}</td>
            <td>{{ $prestamo['n_identidad'] ?? 'N/A' }}</td>
            <td>{{ $prestamo['monto'] ?? 'N/A' }}</td>
            <td>{{ $prestamo['tasa'] ?? 'N/A' }}%</td>
            <td>{{ $prestamo['plazo'] ?? 'N/A' }} meses</td>
            <td>{{ $prestamo['estado'] ?? 'N/A' }}</td>
            <td>{{ $prestamo['tipo'] ?? 'N/A' }}</td>
            <td>{{ $prestamo['tipo_garantia'] ?? 'N/A' }}</td>
            <td>{{ \Carbon\Carbon::parse($prestamo['fecha_inicio'])->format('Y-m-d') }}</td>
            <td style="text-align: center">
                <!-- Botón Ver sin onclick directo -->
                <button class="btn btn-primary btn-sm view-prestamo"
                data-bs-toggle="modal" 
                 data-bs-target="#view"
                data-id="{{ $prestamo['id_prestamo'] }}"
                data-id-persona="{{ $prestamo['id_persona'] }}"
                data-nombre="{{ $prestamo['nombres_apellidos'] }}"
                data-identidad="{{ $prestamo['n_identidad'] }}"
                 data-tipo-persona="{{ $prestamo['tipo_persona'] }}"
                data-total="{{ $prestamo['total_pagado'] }}"
                data-inicio="{{ $prestamo['fecha_inicio'] }}"
                data-vencimiento="{{ $prestamo['fecha_vencimiento'] }}"
                data-tipo="{{ $prestamo['tipo'] }}"
                data-monto="{{ $prestamo['monto'] }}"
                 data-tasa="{{ $prestamo['tasa'] }}"
                data-plazo="{{ $prestamo['plazo'] }}"
                 data-estado="{{ $prestamo['estado'] }}"
                 data-garantia="{{ $prestamo['tipo_garantia'] }}"
>
                <i class="bi bi-eye"></i>
                </button>


                                    <!-- Botón Editar sin onclick directo 
                <button class="btn btn-primary btn-sm edit-prestamo" data-prestamo='@json($prestamo)' data-bs-toggle="modal" data-bs-target="#editPrestamoModal">
                    <i class="fas fa-edit"></i>
                </button>
                -->
                                    <button class="btn btn-success btn-sm edit-prestamo"
                                        data-bs-toggle="modal"
                                        data-bs-target="#edit"
                                        data-id="{{ $prestamo['id_prestamo'] }}"
                                        data-id-persona="{{ $prestamo['id_persona'] }}"
                                        data-nombres="{{ $prestamo['nombres_apellidos'] }}"
                                        data-dni="{{ $prestamo['n_identidad'] }}"
                                        data-total="{{ $prestamo['total_pagado'] }}"
                                        data-inicio="{{ $prestamo['fecha_inicio'] }}"
                                        data-vencimiento="{{ $prestamo['fecha_vencimiento'] }}"
                                        data-tipo="{{ $prestamo['tipo'] }}"
                                        data-monto="{{ $prestamo['monto'] }}"
                                        data-tasa="{{ $prestamo['tasa'] }}"
                                        data-plazo="{{ $prestamo['plazo'] }}"
                                        data-estado="{{ $prestamo['estado'] }}"
                                        data-garantia="{{ $prestamo['tipo_garantia'] }}"
                                        data-modificado-por="{{ auth()->user()->name }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <form action="{{ route('prestamos.destroy', $prestamo['id_prestamo']) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-btn">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="11" class="text-center">No hay préstamos disponibles</td>
                            </tr>
                            @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!-- 
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoPrestamoModal">
            <i class="fas fa-plus"></i> Añadir Nuevo
            </button>
                        </div>
                        </div>
                        -->
        <!-- Modal para insertar-->
        <div class="modal fade" id="nuevoPrestamoModal" tabindex="-1" aria-labelledby="nuevoPrestamoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="nuevoPrestamoModalLabel">Nuevo Préstamo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="nuevoPrestamoForm" action="{{ route('prestamos.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Primera columna -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="id_persona" class="form-label">Seleccionar Persona</label>
                                        <select class="form-control" id="id_persona" name="id_persona" required>
                                            <option value="">Seleccione una persona</option>
                                            @foreach ($personas as $persona)
                                            <option value="{{ $persona->id_persona }}">
                                                {{ $persona->nombres_apellidos }} - {{ $persona->n_identidad }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="total_pagado" class="form-label">Total Pagado</label>
                                        <input type="number" class="form-control" id="total_pagado" name="total_pagado" min="1" step="0.01" max="61000" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="fecha_vencimiento" class="form-label">Fecha Vencimiento</label>
                                        <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="tipo" class="form-label">Tipo</label>
                                        <select class="form-control" id="tipo" name="tipo" required>
                                            <option value="Reingreso">Reingreso</option>
                                            <option value="Refinanciamiento">Refinanciamiento</option>
                                            <option value="Novacion">Novación</option>
                                            <option value="Primera Vez">Primera Vez</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="monto" class="form-label">Monto</label>
                                        <input type="number" class="form-control" id="monto" name="monto" min="1" max="60000" required>
                                    </div>
                                </div>

                                <!-- Segunda columna -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tasa" class="form-label">Tasa (%)</label>
                                        <input type="number" class="form-control" id="tasa" name="tasa" min="1" max="12" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="plazo" class="form-label">Plazo (meses)</label>
                                        <input type="number" class="form-control" id="plazo" name="plazo" min="1" max="48" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="estado" class="form-label">Estado</label>
                                        <select class="form-control" id="estado" name="estado" required>
                                            <option value="aprobado">Aprobado</option>
                                            <option value="pendiente">Pendiente</option>
                                            <option value="rechazado">Rechazado</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="tipo_garantia" class="form-label">Tipo de Garantía</label>
                                        <select class="form-control" id="tipo_garantia" name="tipo_garantia" required>
                                            <option value="Fiduciaria">Fiduciaria</option>
                                            <option value="Prendaria">Prendaria</option>
                                            <option value="Hipotecaria">Hipotecaria</option>
                                            <option value="Solidaria">Solidaria</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="creado_por" class="form-label">Creado Por</label>
                                        <input type="text" class="form-control" id="creado_por" name="creado_por" value="{{ auth()->user()->id }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones alineados -->
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>
            document.getElementById("nuevoPrestamoForm").addEventListener("submit", function(event) {
                let id_persona = document.getElementById("id_persona").value;
                let total_pagado = document.getElementById("total_pagado").value;
                let fecha_inicio = document.getElementById("fecha_inicio").value;
                let fecha_vencimiento = document.getElementById("fecha_vencimiento").value;
                let tipo = document.getElementById("tipo").value;
                let monto = document.getElementById("monto").value;
                let tasa = document.getElementById("tasa").value;
                let plazo = document.getElementById("plazo").value;

                if (isNaN(id_persona) || id_persona <= 0) {
                    alert("Error: ID Persona debe ser un número mayor que 1");
                    event.preventDefault();
                    return;
                }

                if (isNaN(total_pagado) || total_pagado < 0) {
                    alert("Error: Total Pagado no puede ser negativo");
                    event.preventDefault();
                    return;
                }

                if (isNaN(monto) || monto < 1 || monto > 60000) {
                    alert("Error: Monto debe estar entre 1 y 60,000");
                    event.preventDefault();
                    return;
                }

                if (isNaN(tasa) || tasa < 1 || tasa > 12) {
                    alert("Error: Tasa debe estar entre 1% y 12%");
                    event.preventDefault();
                    return;
                }

                if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(tipo)) {
                    alert("Error: Tipo debe contener solo letras, espacios y acentos.");
                    event.preventDefault();
                    return;
                }


                if (isNaN(plazo) || plazo < 1 || plazo > 36) {
                    alert("Error: Plazo debe estar entre 1 y 36 meses");
                    event.preventDefault();
                    return;
                }

                if (new Date(fecha_vencimiento) < new Date(fecha_inicio)) {
                    alert("Error: Fecha de Vencimiento debe ser después de la Fecha de Inicio");
                    event.preventDefault();
                    return;
                }

                // Calcular fecha de vencimiento automáticamente con base en el plazo
                let fechaInicioDate = new Date(fecha_inicio);
                fechaInicioDate.setMonth(fechaInicioDate.getMonth() + parseInt(plazo));
                document.getElementById("fecha_vencimiento").value = fechaInicioDate.toISOString().split("T")[0];
            });
        </script>
        <!-- Tabla de Préstamos -->


        <!-- Modal de vista -->
        <div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Información del Préstamo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>ID Préstamo:</strong> <span id="view-id"></span></p>
                        <p><strong>ID Persona:</strong> <span id="view-id-persona"></span></p>
                        <p><strong>Nombre Completo:</strong> <span id="view-nombre"></span></p>
                        <p><strong>Número de Identidad:</strong> <span id="view-identidad"></span></p>
                        <p><strong>Tipo de Persona:</strong> <span id="view-tipo-persona"></span></p>
                        <p><strong>Total Pagado:</strong> <span id="view-total"></span></p>
                        <p><strong>Fecha Inicio:</strong>
                            {{ $prestamo['fecha_inicio'] ? \Carbon\Carbon::parse($prestamo['fecha_inicio'])->format('d/m/Y') : 'No disponible' }}
                        </p>
                        <p><strong>Fecha Vencimiento:</strong>
                            {{ $prestamo['fecha_vencimiento'] ? \Carbon\Carbon::parse($prestamo['fecha_vencimiento'])->format('d/m/Y') : 'No disponible' }}
                        </p>
                        <p><strong>Tipo de Préstamo:</strong> <span id="view-tipo"></span></p>
                        <p><strong>Monto:</strong> L.<span id="view-monto"></span></p>
                        <p><strong>Tasa de Interés:</strong> <span id="view-tasa"></span>%</p>
                        <p><strong>Plazo:</strong> <span id="view-plazo"></span> meses</p>
                        <p><strong>Estado:</strong> <span id="view-estado"></span></p>
                        <p><strong>Tipo de Garantía:</strong> <span id="view-garantia"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>




        <!-- Modal para Editar Préstamo 
<div class="modal fade" id="editPrestamoModal" tabindex="-1" aria-labelledby="editPrestamoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Préstamo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="updatePrestamoForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id_prestamo">
                    <input type="hidden" id="edit_modificado_por" value="{{ auth()->id() }}">

                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input name="id_persona" label="ID Persona" id="edit_id_persona" />
                            <x-adminlte-input name="nombres_apellidos" label="Nombre de la Persona" id="edit_nombres_apellidos" readonly />
                            <x-adminlte-input name="n_identidad" label="Número de Identidad" id="edit_n_identidad" readonly />
                            <x-adminlte-input name="total_pagado" label="Total Pagado" id="edit_total_pagado" />
                            <x-adminlte-input name="fecha_inicio" label="Fecha Inicio" id="edit_fecha_inicio" type="date" />
                            <x-adminlte-input name="fecha_vencimiento" label="Fecha Vencimiento" id="edit_fecha_vencimiento" type="date" />
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input name="tipo" label="Tipo" id="edit_tipo" />
                            <x-adminlte-input name="monto" label="Monto" id="edit_monto" />
                            <x-adminlte-input name="tasa" label="Tasa (%)" id="edit_tasa" />
                            <x-adminlte-input name="plazo" label="Plazo (meses)" id="edit_plazo" />
                            <x-adminlte-select name="estado" label="Estado" id="edit_estado">
                                <option value="aprobado">Aprobado</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="rechazado">Rechazado</option>
                            </x-adminlte-select>
                            <x-adminlte-select name="tipo_garantia" label="Tipo de Garantía" id="edit_tipo_garantia">
                                <option value="Fiduciaria">Fiduciaria</option>
                                <option value="Prendaria">Prendaria</option>
                                <option value="Hipotecaria">Hipotecaria</option>
                                <option value="Solidaria">Solidaria</option>
                            </x-adminlte-select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
-->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="edit-title" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-title">Modificación Préstamo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-update-prestamo" method="POST">
                    @csrf
                    @method('PUT')

                            <!-- ID Préstamo -->
                            <input type="hidden" id="id_prestamo" name="id_prestamo">

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- ID Persona -->
                                    <div class="mb-3">
                                        <label class="form-label">ID Persona</label>
                                        <input type="number" class="form-control" id="e.id_persona" name="id_persona" readonly>
                                    </div>

                                    <!-- Nombres y DNI -->
                                    <div class="mb-3">
                                        <label class="form-label">Nombres y Apellidos</label>
                                        <input type="text" class="form-control" id="e.nombres_apellidos" name="nombres_apellidos" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">DNI</label>
                                        <input type="text" class="form-control" id="e.n_identidad" name="n_identidad" readonly>
                                    </div>

                                    <!-- Total Pagado -->
                                    <div class="mb-3">
                                        <label class="form-label">Total Pagado</label>
                                        <input type="number" class="form-control" id="e.total_pagado" name="total_pagado" min="1" required>
                                    </div>

                            <!-- Fechas -->
                            <div class="mb-3">
                                <label class="form-label">Fecha Inicio</label>
                                <input type="date" class="form-control" id="e.fecha_inicio" name="fecha_inicio" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fecha Vencimiento</label>
                                <input type="date" class="form-control" id="e.fecha_vencimiento" name="fecha_vencimiento" required readonly>
                            </div>

                                    <!-- Tipo -->
                                    <div class="mb-3">
                                        <label class="form-label">Tipo</label>
                                        <input type="text" class="form-control" id="e.tipo" name="tipo" required>
                                    </div>

                                    <!-- Monto -->
                                    <div class="mb-3">
                                        <label class="form-label">Monto</label>
                                        <input type="number" class="form-control" id="e.monto" name="monto" min="1" max="60000" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Tasa -->
                                    <div class="mb-3">
                                        <label class="form-label">Tasa (%)</label>
                                        <input type="number" class="form-control" id="e.tasa" name="tasa" min="1" max="12" required>
                                    </div>

                                    <!-- Plazo -->
                                    <div class="mb-3">
                                        <label class="form-label">Plazo (meses)</label>
                                        <input type="number" class="form-control" id="e.plazo" name="plazo" min="1" required>
                                    </div>

                                    <!-- Estado -->
                                    <div class="mb-3">
                                        <label class="form-label">Estado</label>
                                        <select class="form-control" id="e.estado" name="estado" required>
                                            <option value="aprobado">Aprobado</option>
                                            <option value="pendiente">Pendiente</option>
                                            <option value="rechazado">Rechazado</option>
                                        </select>
                                    </div>

                                    <!-- Tipo de Garantía -->
                                    <div class="mb-3">
                                        <label class="form-label">Tipo de Garantía</label>
                                        <select class="form-control" id="e.tipo_garantia" name="tipo_garantia" required>
                                            <option value="Fiduciaria">Fiduciaria</option>
                                            <option value="Prendaria">Prendaria</option>
                                            <option value="Hipotecaria">Hipotecaria</option>
                                            <option value="Solidaria">Solidaria</option>
                                        </select>
                                    </div>

                                    <!-- Modificado Por -->
                                    <div class="mb-3">
                                        <label class="form-label">Modificado Por</label>
                                        <input type="text" class="form-control" id="modificado_por" name="modificado_por" value="{{ auth()->user()->id }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById("form-update-prestamo").addEventListener("submit", function(event) {
                event.preventDefault(); // Evita que el formulario se envíe automáticamente

                // Obtener valores
                let id_persona = document.getElementById("e.id_persona").value;
                let total_pagado = document.getElementById("e.total_pagado").value;
                let fecha_inicio = document.getElementById("e.fecha_inicio").value;
                let fecha_vencimiento = document.getElementById("e.fecha_vencimiento");
                let tipo = document.getElementById("e.tipo").value.trim();
                let monto = document.getElementById("e.monto").value;
                let tasa = document.getElementById("e.tasa").value;
                let plazo = document.getElementById("e.plazo").value;

                // Validaciones
                if (isNaN(id_persona) || id_persona < 1) {
                    alert("Error: ID Persona debe ser un número mayor que 1.");
                    return;
                }

                if (isNaN(total_pagado) || total_pagado < 1) {
                    alert("Error: Total Pagado debe ser un número mayor que 1.");
                    return;
                }

                if (isNaN(monto) || monto < 1 || monto > 60000) {
                    alert("Error: Monto debe estar entre 1 y 60,000.");
                    return;
                }

                if (isNaN(tasa) || tasa < 1 || tasa > 12) {
                    alert("Error: Tasa debe estar entre 1% y 12%.");
                    return;
                }

                if (!/^[a-zA-Z\s]+$/.test(tipo)) {
                    alert("Error: Tipo debe contener solo letras y espacios.");
                    return;
                }

                if (isNaN(plazo) || plazo < 1 || plazo > 36) {
                    alert("Error: Plazo debe estar entre 1 y 36 meses");
                    return;
                }

                if (new Date(fecha_inicio) > new Date()) {
                    alert("Error: La fecha de inicio no puede estar en el futuro.");
                    return;
                }

                // Calcular fecha de vencimiento sumando los meses del plazo
                let fechaInicioDate = new Date(fecha_inicio);
                fechaInicioDate.setMonth(fechaInicioDate.getMonth() + parseInt(plazo));
                fecha_vencimiento.value = fechaInicioDate.toISOString().split("T")[0];

    // Enviar formulario después de validaciones
    event.target.submit();
});
</script>
<!-- Script para asignar datos al modal -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".edit-prestamo").forEach(button => {
        button.addEventListener("click", function () {
            document.getElementById("id_prestamo").value = this.getAttribute("data-id");
            document.getElementById("e.id_persona").value = this.getAttribute("data-id-persona");
            document.getElementById("e.nombres_apellidos").value = this.getAttribute("data-nombres");
            document.getElementById("e.n_identidad").value = this.getAttribute("data-dni");
            document.getElementById("e.total_pagado").value = parseFloat(this.getAttribute("data-total")).toFixed(2);
            document.getElementById("e.fecha_inicio").value = this.getAttribute("data-inicio");
            document.getElementById("e.fecha_vencimiento").value = this.getAttribute("data-vencimiento");
            document.getElementById("e.tipo").value = this.getAttribute("data-tipo");
            document.getElementById("e.monto").value = parseFloat(this.getAttribute("data-monto")).toFixed(2);
            document.getElementById("e.tasa").value = this.getAttribute("data-tasa");
            document.getElementById("e.plazo").value = this.getAttribute("data-plazo");
            document.getElementById("e.estado").value = this.getAttribute("data-estado");
            document.getElementById("e.tipo_garantia").value = this.getAttribute("data-garantia");
            //document.getElementById("modificado_por").value = this.getAttribute("data-modificado-por");

                        // Actualiza la acción del formulario con el ID correcto
                        document.getElementById("form-update-prestamo").action = "/prestamos/" + this.getAttribute("data-id");
                    });
                });
            });

            $(document).on('click', '.edit-prestamo', function() {
                $('#id_prestamo').val($(this).data('id'));
                $('#id_persona').val($(this).data('id-persona'));
                $('#total_pagado').val($(this).data('total'));
                $('#fecha_inicio').val($(this).data('inicio'));
                $('#fecha_vencimiento').val($(this).data('vencimiento'));
                $('#tipo').val($(this).data('tipo'));
                $('#monto').val($(this).data('monto'));
                $('#tasa').val($(this).data('tasa'));
                $('#plazo').val($(this).data('plazo'));
                $('#estado').val($(this).data('estado'));
                $('#tipo_garantia').val($(this).data('garantia'));
                $('#modificado_por').val($(this).data('modificado-por'));
            });
        </script>





        <!-- Script para asignar el id_prestamo al modal -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editButtons = document.querySelectorAll('.edit-prestamo');

                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const idPrestamo = button.getAttribute('data-id');
                        const idPersona = button.getAttribute('data-id-persona');
                        const totalPagado = button.getAttribute('data-total-pagado');
                        const fechaInicio = button.getAttribute('data-fecha-inicio');
                        const fechaVencimiento = button.getAttribute('data-fecha-vencimiento');
                        const tipo = button.getAttribute('data-tipo');
                        const monto = button.getAttribute('data-monto');
                        const tasa = button.getAttribute('data-tasa');
                        const plazo = button.getAttribute('data-plazo');
                        const estado = button.getAttribute('data-estado');
                        const tipoGarantia = button.getAttribute('data-tipo-garantia');
                        const modificadoPor = button.getAttribute('data-modificado-por');

                        // Asignar los valores al formulario del modal
                        document.getElementById('id_prestamo').value = idPrestamo;
                        document.getElementById('id_persona').value = idPersona;
                        document.getElementById('total_pagado').value = totalPagado;
                        document.getElementById('fecha_inicio').value = fechaInicio;
                        document.getElementById('fecha_vencimiento').value = fechaVencimiento;
                        document.getElementById('tipo').value = tipo;
                        document.getElementById('monto').value = monto;
                        document.getElementById('tasa').value = tasa;
                        document.getElementById('plazo').value = plazo;
                        document.getElementById('estado').value = estado;
                        document.getElementById('tipo_garantia').value = tipoGarantia;
                        document.getElementById('modificado_por').value = modificadoPor;
                    });
                });
            });
        </script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".view-prestamo").forEach(button => {
        button.addEventListener("click", function () {
            document.getElementById("view-id").textContent = this.getAttribute("data-id");
            document.getElementById("view-id-persona").textContent = this.getAttribute("data-id-persona");
            document.getElementById("view-nombre").textContent = this.getAttribute("data-nombre");
            document.getElementById("view-identidad").textContent = this.getAttribute("data-identidad");
            document.getElementById("view-tipo-persona").textContent = this.getAttribute("data-tipo-persona");
            document.getElementById("view-total").textContent = this.getAttribute("data-total");
            document.getElementById("view-inicio").textContent = this.getAttribute("data-inicio");
            document.getElementById("view-vencimiento").textContent = this.getAttribute("data-vencimiento");
            document.getElementById("view-tipo").textContent = this.getAttribute("data-tipo");
            document.getElementById("view-monto").textContent = this.getAttribute("data-monto");
            document.getElementById("view-tasa").textContent = this.getAttribute("data-tasa");
            document.getElementById("view-plazo").textContent = this.getAttribute("data-plazo");
            document.getElementById("view-estado").textContent = this.getAttribute("data-estado");
            document.getElementById("view-garantia").textContent = this.getAttribute("data-garantia");
        });
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function () {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest("form").submit(); // Envía el formulario si confirma
                }
            });
        });
    });
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
                $('#prestamoTable').DataTable({
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
                    buttons: [{
                            text: '<i class="fas fa-copy"></i> COPIAR',
                            extend: 'copy',
                            className: 'btn btn-success'
                        },
                        {
                            text: '<i class="fas fa-file-csv"></i> CSV',
                            extend: 'csv',
                            className: 'btn btn-success'
                        },
                        {
                            text: '<i class="fas fa-print"></i> IMPRIMIR',
                            extend: 'print',
                            className: 'btn btn-success'
                        },
                        {
                            text: '<i class="fas fa-file-pdf"></i> PDF',
                            extend: 'pdf',
                            className: 'btn btn-success'
                        },
                        {
                            text: '<i class="fas fa-file-excel"></i> EXCEL',
                            extend: 'excel',
                            className: 'btn btn-success'
                        },
                    ]
                });
            });
        </script>
        @stop

        @endsection

        @section('css')



        @section('js')
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            $(document).on('click', '.view-prestamo', function() {
                let prestamo = $(this).data('prestamo'); // Obtener datos desde el botón

                // Llenar el modal con los datos del préstamo
                $('#view-id_prestamo').text(prestamo.id);
                $('#view-id_persona').text(prestamo.id_persona);
                $('#view-total_pagado').text(prestamo.total_pagado);
                $('#view-fecha_inicio').text(prestamo.fecha_inicio);
                $('#view-fecha_vencimiento').text(prestamo.fecha_vencimiento);
                $('#view-tipo').text(prestamo.tipo);
                $('#view-monto').text(prestamo.monto);
                $('#view-tasa').text(prestamo.tasa);
                $('#view-plazo').text(prestamo.plazo);
                $('#view-estado').text(prestamo.estado);
                $('#view-tipo_garantia').text(prestamo.tipo_garantia);
                $('#view-modificado_por').text(prestamo.modificado_por);

                // Mostrar el modal
                $('#viewPrestamoModal').modal('show');
            });
        </script>
        <script>
            //Modal para Editar Préstamo 
            // Mostrar modal de edición y llenar los campos
            document.addEventListener('DOMContentLoaded', function() {
                // Escucha el evento de apertura del modal
                $('#edit').on('show.bs.modal', function(event) {
                    // El botón que activó el modal es el origen del evento
                    var button = $(event.relatedTarget); // El botón que disparó el modal
                    var prestamo = JSON.parse(button.data('prestamo')); // Obtener los datos del préstamo del atributo data-prestamo

                    // Actualizar la acción del formulario con el ID del préstamo
                    var form = $(this).find('form');
                    form.attr('action', '/prestamos/update/' + prestamo.id_prestamo);

                    // Llenar los campos del formulario con los datos del préstamo
                    $('#id_prestamo').val(prestamo.id_prestamo); // Actualiza el campo id_prestamo
                    $('#id_persona').val(prestamo.id_persona);
                    $('#total_pagado').val(prestamo.total_pagado);
                    $('#fecha_inicio').val(formatFecha(prestamo.fecha_inicio));
                    $('#fecha_vencimiento').val(formatFecha(prestamo.fecha_vencimiento));
                    $('#tipo').val(prestamo.tipo);
                    $('#monto').val(prestamo.monto);
                    $('#tasa').val(prestamo.tasa);
                    $('#plazo').val(prestamo.plazo);
                    $('#estado').val(prestamo.estado);
                    $('#tipo_garantia').val(prestamo.tipo_garantia);
                    $('#modificado_por').val(prestamo.modificado_por);
                });

                // Función para formatear las fechas en formato 'YYYY-MM-DD'
                function formatFecha(fecha) {
                    if (!fecha) return "";
                    var date = new Date(fecha);
                    return date.toISOString().split('T')[0]; // Devuelve la fecha en formato YYYY-MM-DD
                }
            });

            // Escuchar el evento de submit del formulario
            $('#edit form').on('submit', function(e) {
                e.preventDefault(); // Evita que el formulario se envíe de forma tradicional

                var form = $(this);

                $.ajax({
                    url: form.attr('action'), // Obtiene la URL del formulario
                    type: form.attr('method'), // Obtiene el método de envío del formulario (generalmente POST o PUT)
                    data: form.serialize(), // Serializa los datos del formulario
                    success: function(response) {
                        // Aquí va lo que se hará luego de que el formulario sea enviado con éxito
                        console.log('Formulario enviado exitosamente');

                        // Limpiar los campos del formulario luego de que se envíe
                        form[0].reset(); // Resetea los campos del formulario
                        $('#edit').modal('hide'); // Cierra el modal
                    },
                    error: function(xhr, status, error) {
                        console.log('Error al enviar el formulario:', error);
                    }
                });
            });
        </script>
        @endsection
        @stop