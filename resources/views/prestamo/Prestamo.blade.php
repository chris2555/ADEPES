@extends('adminlte::page')

@section('title', 'Gestión de Prestamos')
@section('plugins.Sweetalert2', true)

@section('content_header')
 
@stop

@section('content')

<head>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<div class="container-fluid mt-4">
    <div class="shadow-lg p-5 bg-white">
        <div class="card-header text-success text-center">
            <h4 class="mb-0"><i class="fas fa-money-bill-wave"></i> Gestión de Préstamos</h4>
        </div>

        <!-- Botón "Nuevo Préstamo" -->
        <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoPrestamoModal">
            <i class="fas fa-plus"></i> Añadir Nuevo
        </button>
    </div>
<!-- Modal para insertar-->
<div class="modal fade" id="nuevoPrestamoModal" tabindex="-1" aria-labelledby="nuevoPrestamoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoPrestamoModalLabel">Nuevo Préstamo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <form action="{{ route('prestamos.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                        <div class="mb-3">
                            <label for="id_persona" class="form-label">ID Persona</label>
                            <input type="text" class="form-control" id="id_persona" name="id_persona" required>
                        </div>
                            <div class="mb-3">
                                <label for="total_pagado" class="form-label">Total Pagado</label>
                                <input type="text" class="form-control" id="total_pagado" name="total_pagado" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_vencimiento" class="form-label">Fecha Vencimiento</label>
                                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo</label>
                                <input type="text" class="form-control" id="tipo" name="tipo" required>
                            </div>
                            <div class="mb-3">
                                <label for="monto" class="form-label">Monto</label>
                                <input type="text" class="form-control" id="monto" name="monto" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tasa" class="form-label">Tasa</label>
                                <input type="text" class="form-control" id="tasa" name="tasa" required>
                            </div>
                            <div class="mb-3">
                                <label for="plazo" class="form-label">Plazo</label>
                                <input type="text" class="form-control" id="plazo" name="plazo" required>
                            </div>
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-control" id="estado" name="estado" required>
                                    <option value="aprobado">aprobado</option>
                                    <option value="pendiente">pendiente</option>
                                    <option value="rechazado">rechazado</option>
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
                                <input type="text" class="form-control" id="creado_por" name="creado_por" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
        <!-- Tabla de Préstamos -->
        <div class="table-responsive">
            <table id="prestamoTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>DNI</th>
                        <th>Monto</th>
                        <th>Interés</th>
                        <th>Plazo</th>
                        <th>Estado</th>
                        <th>Tipo</th>
                        <th>Garantia</th>
                        <th>Fecha Inicio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @if(isset($prestamos) && is_array($prestamos) && count($prestamos) > 0)
    @foreach($prestamos as $prestamo)
        <tr>
            <td>{{ $prestamo['id_prestamo'] ?? 'N/A' }}</td>
            <td>{{ $prestamo['nombres_apellidos'] ?? 'N/A' }}</td>
            <td>{{ $prestamo['n_identidad'] ?? 'N/A' }}</td>
            <td>{{ $prestamo['monto'] ?? 'N/A' }}</td>
            <td>{{ $prestamo['tasa'] ?? 'N/A' }}%</td>
            <td>{{ $prestamo['plazo'] ?? 'N/A' }} meses</td>
            <td>{{ $prestamo['estado'] ?? 'N/A' }}</td>
            <td>{{ $prestamo['tipo'] ?? 'N/A' }}</td>
            <td>{{ $prestamo['tipo_garantia'] ?? 'N/A' }}</td>
            <td>{{ $prestamo['fecha_inicio'] ?? 'N/A' }}</td>
            <td>
                <!-- Botón Ver sin onclick directo -->
                <button class="btn btn-info btn-sm view-prestamo" data-prestamo='@json($prestamo)'>
                <i class="fas fa-eye"></i> Ver
                </button>

                <!-- Botón Editar sin onclick directo 
                <button class="btn btn-primary btn-sm edit-prestamo" data-prestamo='@json($prestamo)' data-bs-toggle="modal" data-bs-target="#editPrestamoModal">
                    <i class="fas fa-edit"></i>
                </button>
                -->
                <!-- Este botón se usa para abrir el modal -->
  <!-- Este botón abre el modal sin enviar datos -->
<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit">
    <i class="fas fa-edit"></i>
</button>







                <!-- Botón Eliminar -->
                <form action="{{ route('prestamos.destroy', $prestamo['id_prestamo']) }}" method="POST" class="d-inline delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-warning btn-sm delete-btn">
                        <i class="fa fa-trash"></i>
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

<!-- Modal view -->
<div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Información del Préstamo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="viewModalBody">
                    <!-- Aquí se insertan los datos -->
                </div>
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
<!-- Modal de edición -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="edit-title" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-title">Modificación Préstamo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de edición -->
                <form id="form-update-prestamo" action="{{ route('prestamos.update', ['id' => 1]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="id_prestamo" class="form-label">ID Préstamo</label>
                        <input type="text" class="form-control" id="id_prestamo" name="id_prestamo" required>
                    </div>

                    <div class="row">
                        <!-- Primera columna -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_persona" class="form-label">ID Persona</label>
                                <input type="text" class="form-control" id="id_persona" name="id_persona" required>
                            </div>
                            <div class="mb-3">
                                <label for="total_pagado" class="form-label">Total Pagado</label>
                                <input type="text" class="form-control" id="total_pagado" name="total_pagado" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_vencimiento" class="form-label">Fecha Vencimiento</label>
                                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo</label>
                                <input type="text" class="form-control" id="tipo" name="tipo" required>
                            </div>
                            <div class="mb-3">
                                <label for="monto" class="form-label">Monto</label>
                                <input type="text" class="form-control" id="monto" name="monto" required>
                            </div>
                        </div>

                        <!-- Segunda columna -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tasa" class="form-label">Tasa</label>
                                <input type="text" class="form-control" id="tasa" name="tasa" required>
                            </div>
                            <div class="mb-3">
                                <label for="plazo" class="form-label">Plazo</label>
                                <input type="text" class="form-control" id="plazo" name="plazo" required>
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
                                <label for="modificado_por" class="form-label">Modificado Por</label>
                                <input type="text" class="form-control" id="modificado_por" name="modificado_por" required>
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




<!-- Script para asignar el id_prestamo al modal -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-prestamo');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
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



@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="//code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   $(document).ready(function () {
        $('#prestamoTable').DataTable({
            responsive: true,
            autoWidth: false,
            language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json' },
            dom: 'Bfrtip',
            buttons: ['copy', 'excel', 'pdf', 'csv']
        });
    });
</script>
@stop

@endsection

@section('css')

<style>


#clienteTable_wrapper {
    margin-left: auto;
    width: 67%; /* Ajusta este valor según lo que necesites */
}
    
    .container-fluid {
        width: 100vw;
        height: 100vh;
        padding: 0px;
    }

 .dt-buttons .btn {
    color: success !important;
    border: none !important;
}
.dt-buttons .btn:hover {
    filter: brightness(85%);
}

.card {
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}
.table {
    font-size: 24px;
}
.dt-buttons .btn {
    margin: 5px;
    font-size: 14px;
    border-radius: 8px;
    transition: all 0.3s ease;
}
.dt-buttons .btn:hover {
    filter: brightness(85%);
}
.btn-sm {
    border-radius: 5px;
}
</style>

@section('js')
<script src="{{ asset('js/app.js') }}"></script>
<!--
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".view-prestamo").forEach(button => {
        button.addEventListener("click", function () {
            // Obtener el JSON del atributo data-prestamo y decodificarlo
            let prestamo = JSON.parse(this.getAttribute("data-prestamo"));

            // Insertar la información en el modal
            let modalBody = document.getElementById("viewModalBody");
            modalBody.innerHTML = `
                <p><strong>ID Préstamo:</strong> ${prestamo.id_prestamo ?? 'N/A'}</p>
                <p><strong>Nombre:</strong> ${prestamo.nombres_apellidos ?? 'N/A'}</p>
                <p><strong>Número de Identidad:</strong> ${prestamo.n_identidad ?? 'N/A'}</p>
                <p><strong>Monto:</strong> ${prestamo.monto ?? 'N/A'}</p>
                <p><strong>Tasa:</strong> ${prestamo.tasa ?? 'N/A'}%</p>
                <p><strong>Plazo:</strong> ${prestamo.plazo ?? 'N/A'} meses</p>
                <p><strong>Estado:</strong> ${prestamo.estado ?? 'N/A'}</p>
                <p><strong>Tipo:</strong> ${prestamo.tipo ?? 'N/A'}</p>
                <p><strong>Garantía:</strong> ${prestamo.tipo_garantia ?? 'N/A'}</p>
                <p><strong>Fecha Inicio:</strong> ${prestamo.fecha_inicio ? new Date(prestamo.fecha_inicio).toLocaleDateString() : 'N/A'}</p>
                <p><strong>Fecha Vencimiento:</strong> ${prestamo.fecha_vencimiento ? new Date(prestamo.fecha_vencimiento).toLocaleDateString() : 'N/A'}</p>
            `;

            // Mostrar el modal con Bootstrap
            var modal = new bootstrap.Modal(document.getElementById("view"));
            modal.show();
        });
    });
});
</script>
-->
<script>

//Modal para Editar Préstamo 
    // Mostrar modal de edición y llenar los campos
    document.addEventListener('DOMContentLoaded', function () {
    // Escucha el evento de apertura del modal
    $('#edit').on('show.bs.modal', function (event) {
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
    $('#edit form').on('submit', function (e) {
        e.preventDefault(); // Evita que el formulario se envíe de forma tradicional

        var form = $(this);
        
        $.ajax({
            url: form.attr('action'), // Obtiene la URL del formulario
            type: form.attr('method'), // Obtiene el método de envío del formulario (generalmente POST o PUT)
            data: form.serialize(), // Serializa los datos del formulario
            success: function (response) {
                // Aquí va lo que se hará luego de que el formulario sea enviado con éxito
                console.log('Formulario enviado exitosamente');

                // Limpiar los campos del formulario luego de que se envíe
                form[0].reset(); // Resetea los campos del formulario
                $('#edit').modal('hide'); // Cierra el modal
            },
            error: function (xhr, status, error) {
                console.log('Error al enviar el formulario:', error);
            }
        });
    });
</script>
<!--
 <script>
$("#updatePrestamoForm").submit(function(e) {
    e.preventDefault();

    let id = $("#edit_id_prestamo").val();
    let data = {
        id_persona: $("#edit_id_persona").val(),
        total_pagado: $("#edit_total_pagado").val(),
        fecha_inicio: $("#edit_fecha_inicio").val(),
        fecha_vencimiento: $("#edit_fecha_vencimiento").val(),
        tipo: $("#edit_tipo").val(),
        monto: $("#edit_monto").val(),
        tasa: $("#edit_tasa").val(),
        plazo: $("#edit_plazo").val(),
        estado: $("#edit_estado").val(),
        tipo_garantia: $("#edit_tipo_garantia").val(),
        modificado_por: $("#edit_modificado_por").val(), // Capturando el ID del usuario autenticado
    };

    fetch(`http://localhost:3000/api/prestamo/${id}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(response => {
        if (response) {
            Swal.fire({
                icon: 'success',
                title: 'Préstamo actualizado correctamente',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                location.reload(); // Recargar la página después de la actualización
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error al actualizar el préstamo',
                text: response.error || 'Intenta nuevamente'
            });
        }
    })
    .catch(error => console.error("Error:", error));
});
-->
    </script>
    <script>
    // Confirmar eliminación con SweetAlert
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            var form = this.closest('form');

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
                    form.submit();
                }
            });
        });
    });
    </script>
</script>
@endsection
@stop