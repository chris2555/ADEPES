@extends('adminlte::page')

@section('title', 'Gestión de Roles')

@section('content_header')
    <h1><b>Listado de Roles</b></h1>
    </hr>
@stop

@section('content')
<div class='row'> 
    <div class="col-md-12">
    <div class="card card-outline card-success">
    <div class="card-header text-success text-center">
    
    <h4 class="card-title"><i class="fas fa-user-shield"></i> Gestión de Roles</h4>
    <div class="d-flex justify-content-end gap-3 mb-3">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearRolModal">
        <i class="fas fa-plus"></i> Crear Rol
    </button>
    <a href="{{ route('roles.index') }}" class="btn btn-success">
        <i class="fas fa-users"></i> Ver Roles asignados
    </a>
</div>
            </div>
            <div class="d-flex justify-content-end">
                <div class="table-responsive ms-auto">
            <div class="card-body">
                <table id="rolesTable" class="table table-bordered table-hover table-striped table-sm" >
                <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Nombre del Rol</th>
                            <th class="text-center">Guard Name</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($roles as $role)
                            <tr>
                                
                                <td class="text-center">{{ $role->id }}</td>
                                <td class="text-center">{{ $role->name }}</td>
                                <td class="text-center">{{ $role->guard_name }}</td>
                                <td>
                                
                                    <form action="{{ route('verroles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <div class="d-flex justify-content-center ">
                                        <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 4px  4px 0px"><i class="fas fa-trash"></i></button>
                                    </form>
                                    <a href="{{ route('verroles.edit', $role->id) }}" class="btn btn-secondary btn-sm" style="border-radius: 4px 0px 0px 4px">
                                        <i class="fas fa-key"></i>

                                    </a>
                                    </td>
                                </td>
                            </tr>
                            </div>
                        @empty
                            <tr>
                                
                                <td colspan="4" class="text-center">No hay roles disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="crearRolModal" tabindex="-1" aria-labelledby="crearRolModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearRolModalLabel">Crear Nuevo Rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('verroles.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Rol:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="guard_name" class="form-label">Guard Name:</label>
                            <select class="form-select @error('guard_name') is-invalid @enderror" id="guard_name" name="guard_name">
                                <option value="web" {{ old('guard_name') == 'web' ? 'selected' : '' }}>web</option>
                                <option value="api" {{ old('guard_name') == 'api' ? 'selected' : '' }}>api</option>
                            </select>
                            @error('guard_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Crear Rol</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
  <style>
 
    /*Fondo trasnparente y sin borde en el contenedor*/
    #rolesTable_wrapper .dt-buttons {
      background-color: transparent;
      box-shadow: none;
      border: none;
      display: flex;
      justify-content: center;/*Centrar los botenes */
      gap: 10px;/*Espaciado entre botenes*/
      margin-bottom: 15px; /*Separar botones de la tabla*/
    }

    /*Estilo personalizado para los botones*/
    #rolesTable_wrapper .btn {
      color: #fff;
      border-radius: 4px;
      padding: 5px 15px;
      font-size: 14px;
    }

    /*Colores por tipo de botonn*/
    .btn-danger { backgroung-color: #dc3545; border: none; }
    .btn-success { backgroung-color: #28a745; border: none; }
    .btn-info { backgroung-color: #17a2b8; border: none; }
    .btn-warning { backgroung-color: #ffc107; color: #212529; border: none; }
    .btn-default { backgroung-color: #6e7176; color: #212529; border: none; }

    .btn-success {
    margin-right: 20px; /* Ajusta el margen derecho del botón Crear Rol */
}
  </style>
@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if(session('mensaje'))
            Swal.fire({
                title: "{{ session('mensaje') }}",
                icon: "{{ session('icono') }}",
                showConfirmButton: false,
                timer: 2500
            });
        @endif
    });
</script>
    <script>
  $(function () {
   $('#rolesTable').DataTable({
    "pageLength": 5,
    "language": {
      "emptyTable": "No hay informacion",
      "info": "Mostrando_START_a_END_de_TOTAL_ Configuraciones",
      "infoEmpty": "Mostrando 0 a 0 de 0 Configuraciones",
      "infoFiltered": "(Filtrado de _MAX_ total Configuraciones)",
      "lengthMenu": "Mostrar_MENU_Configuraciones",
      "loadingRecords": "Cargando...",
      "processing": "Procesando...",
      "search": "Buscador:",
      "zeroRecords": "Sin resultados encontrados",
      "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
      }

    },
    "responsive": true,
    "lengthChange": true,
    "autoWidth": false,
    buttons: [
      { text: '<i class="fas fa-copy"></i> COPIAR', extend: 'copy', className: 'btn btn-info' },
      { text: '<i class="fas fa-file-csv"></i> CSV', extend: 'csv', className: 'btn btn-info' },
      { text: '<i class="fas fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-info' },
      { text: '<i class="fas fa-file-pdf"></i> PDF', extend: 'pdf', className: 'btn btn-info' },
      { text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-info' },
    ]
    }).buttons().container().appendTo('#rolesTable_wrapper .col-md-6:eq(0)');
   });

   </script>
@stop

