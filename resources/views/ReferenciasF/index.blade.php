@extends('adminlte::page')

@section('title', 'Gestión de Referencias Familiares')
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
                                <a href="javascript:void(0);" class="btn btn-success btn-sm" onclick="viewModal({{ json_encode($referencia) }})">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('referencias.show', $referencia['id_referencia'])}}" class="btn btn-outline-primary btn-sm">
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
                <h5 class="modal-title" id="nuevareferencia">Agregar Nueva Referencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="insertForm" action="{{ route('referencias.store') }}" method="POST">
                    @csrf
                    <x-adminlte-input name="id_solicitud" label="ID solicitud" required fgroup-class="mb-3" />
                    <x-adminlte-input name="nombre_familiar" label="Nombre del Familiar" required fgroup-class="mb-3" />
                    <x-adminlte-input name="parentesco" label="Parentesco" fgroup-class="mb-3" />
                    <x-adminlte-textarea name="direccion_familiar" label="Dirección" fgroup-class="mb-3" rows="3" />
                    <input type="hidden" name="creado_por" value="{{ auth()->user()->id }}">
                    <div class="modal-footer">
                        <x-adminlte-button label="Cancelar" data-bs-dismiss="modal" class="btn-secondary" />
                        <x-adminlte-button type="submit" label="Guardar Referencia" theme="success" icon="fas fa-save" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Edición -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Referencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id_referencia" name="id_referencia">
                    <x-adminlte-input name="nombre_familiar" id="edit_nombre_familiar" label="Nombre del Familiar" required fgroup-class="mb-3" />
                    <x-adminlte-input name="parentesco" id="edit_parentesco" label="Parentesco" fgroup-class="mb-3" />
                    <x-adminlte-textarea name="direccion_familiar" id="edit_direccion_familiar" label="Dirección" fgroup-class="mb-3" rows="3" />
                    <input type="hidden" name="modificado_por" value="{{ auth()->user()->id }}">
                    <div class="modal-footer">
                        <x-adminlte-button label="Cancelar" data-bs-dismiss="modal" class="btn-secondary" />
                        <x-adminlte-button type="submit" label="Actualizar Referencia" theme="success" icon="fas fa-save" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para manejar los modales -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-view").forEach(button => {
        button.addEventListener("click", function () {
            let referenciaId = this.getAttribute("data-id");
            fetch(/referencias/${referenciaId})
                .then(response => response.text())
                .then(data => {
                    document.getElementById("viewModalBody").innerHTML = data;
                    new bootstrap.Modal(document.getElementById("view")).show();
                });
        });
    });
    document.querySelectorAll(".btn-edit").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.getAttribute("data-id");
            let nombre_familiar = this.getAttribute("data-nombre_familiar");
            let parentesco = this.getAttribute("data-parentesco");
            let direccion_familiar = this.getAttribute("data-direccion_familiar");
            document.getElementById("edit_id_referencia").value = id;
            document.getElementById("edit_nombre_familiar").value = nombre_familiar;
            document.getElementById("edit_parentesco").value = parentesco;
            document.getElementById("edit_direccion_familiar").value = direccion_familiar;
            document.getElementById("editForm").setAttribute("action", /referencias/${id});
            new bootstrap.Modal(document.getElementById("edit")).show();
        });
    });
});
</script>
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
        $('#referenciaTable').DataTable({
            responsive: true,
            autoWidth: false,
            language: { url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json' },
            dom: 'Bfrtip',
            buttons: ['copy', 'excel', 'pdf', 'csv']
        });
    });
</script>


@section('js')
<script>
    $(document).ready(function() {
        $('#referenciasTable').DataTable({
            responsive: true,
            autoWidth: false,
            language: { url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json' }
        });
    });
    function viewModal(referencia) {
        var modalBody = document.getElementById('viewModalBody');
        modalBody.innerHTML = `
            <p><strong>Nombre:</strong> ${referencia.nombre_familiar}</p>
            <p><strong>Parentesco:</strong> ${referencia.parentesco || 'No especificado'}</p>
            <p><strong>Dirección:</strong> ${referencia.direccion_familiar || 'No disponible'}</p>
            <p><strong>Creado por:</strong> ${referencia.creado_por}</p>
            <p><strong>Creado en:</strong> ${referencia.creado_en ? new Date(referencia.creado_en).toLocaleString() : 'No disponible'}</p>
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


@stop