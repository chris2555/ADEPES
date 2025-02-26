@extends('adminlte::page')

@section('title', 'Gestión de Clientes')
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
<!-- Modal -->
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
    @if(!empty($prestamos) && is_array($prestamos))
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
                           <a href="javascript:void(0);" class="btn btn-success btn-sm"
                              onclick="viewModal({{ json_encode($prestamos) }})">
                              <i class="fa fa-eye"></i>
                           </a>
                              <a href="{{ route('prestamos.edit') }}"
                              class="btn btn-outline-primary btn-sm">
                              <i class="fas fa-edit"></i> Editar
                              </a>
                              <form action="{{ route('prestamos.destroy') }}"
                               method="POST" class="d-inline">
                               @csrf
                                @method('DELETE')
                                 <button type="submit" class="btn btn-outline-warning btn-sm"
                                    onclick="return confirm('¿Está seguro de eliminar esta relación?')">
                                 <i class="fas fa-trash"></i> Eliminar
                              </button>
                        </form>
                  </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8" class="text-center">No hay préstamos disponibles</td>
        </tr>
    @endif
</tbody>

            </table>
        </div>
    </div>
</div>


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
    width: 80%; /* Ajusta este valor según lo que necesites */
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
@stop
