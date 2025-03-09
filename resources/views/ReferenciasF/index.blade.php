@extends('adminlte::page')

@section('title', 'Gestión de Referencias Familiares')
@section('plugins.Sweetalert2', true)

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
            <h4 class="mb-0"><i class="fas fa-users"></i> Gestión de Referencias Familiares</h4>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevareferencia">
                <i class="fas fa-plus"></i> Nueva Referencia
            </button>
        </div>

        <div class="table-responsive">
            <table id="referenciasTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Solicitud</th>
                        <th>Nombre</th>
                        <th>Parentesco</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($referencias as $referencia)
                        <tr>
                            <td>{{ $referencia['id_referencia'] }}</td>
                            <td>{{ $referencia['id_solicitud'] }}</td>
                            <td>{{ $referencia['nombre_familiar'] }}</td>
                            <td>{{ $referencia['parentesco'] }}</td>
                            <td>{{ $referencia['direccion_familiar'] }}</td>
                            <td>
                                <button class="btn btn-success btn-sm btn-view" data-prestamo="{{ json_encode($referencia) }}">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <a href="{{ route('referencias.show', $referencia['id_referencia']) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>

                <form action="{{ route('referencias.destroy', $referencia['id_referencia']) }}" method="POST" class="d-inline delete-form">
                @csrf
                @method('DELETE')
                 <button type="submit" class="btn btn-outline-warning btn-sm delete-btn"
                onclick="return confirm('¿Está seguro de eliminar este Prestamo?')">
        
                  <i class="fa fa-trash"></i>
                </button>
                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de Visualización -->
<div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Información de Referencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="viewModalBody"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Insertar Nueva Referencia -->
<div class="modal fade" id="nuevareferencia" tabindex="-1" aria-labelledby="nuevareferenciaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Nueva Referencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="insertForm" action="{{ route('referencias.store') }}" method="POST">
                    @csrf
                    <x-adminlte-input name="id_solicitud" label="ID Solicitud" required fgroup-class="mb-3" />
                    <x-adminlte-input name="nombre_familiar" label="Nombre del Familiar" required fgroup-class="mb-3" />
                    <x-adminlte-input name="parentesco" label="Parentesco" fgroup-class="mb-3" />
                    <x-adminlte-textarea name="direccion_familiar" label="Dirección" fgroup-class="mb-3" rows="3" />
                    <x-adminlte-textarea name="creado_por" label="Creado por" fgroup-class="mb-3" rows="3" />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Referencia</button>
                    </div>
                </form>
            </div>
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
@section('js')
<script>
    $(document).ready(function() {
        $('#referenciasTable').DataTable({
            responsive: true,
            autoWidth: false,
            language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json' }
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".btn-view").forEach(button => {
            button.addEventListener("click", function () {
                let referencia = JSON.parse(this.getAttribute("data-prestamo"));
                let modalBody = document.getElementById("viewModalBody");

                modalBody.innerHTML = `
                    <p><strong>Nombre:</strong> ${referencia.nombre_familiar}</p>
                    <p><strong>Parentesco:</strong> ${referencia.parentesco || 'No especificado'}</p>
                    <p><strong>Dirección:</strong> ${referencia.direccion_familiar || 'No disponible'}</p>
                `;

                new bootstrap.Modal(document.getElementById("view")).show();
            });
        });

        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function () {
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
                        this.closest("form").submit();
                    }
                });
            });
        });
    });
</script>
@stop
