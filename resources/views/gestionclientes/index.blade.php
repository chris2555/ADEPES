@extends('adminlte::page')

@section('title', 'Gestión de Clientes')
@section('plugins.Sweetalert2', true)

@section('content_header')
 
@stop

@section('content')
<head>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
</head>

<div class='row'> 
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <div class="container-fluid mt-4">
                    <div class="shadow-lg p-5 bg-white">
                        <div class="card-header text-success text-center">
            <h4 class="mb-0"><i class="fas fa-users"></i> Gestión de Clientes</h4> 
                        </div>
                        <div class="card-header d-flex justify-content-end">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevoClienteModal">
                                <i class="fas fa-plus"></i> Añadir Nuevo
                            </button>
                        </div>

                        <!-- Contenedor de la tabla -->
                        <div class="d-flex justify-content-end">
                            <div class="table-responsive table-hover table-striped table-sm">
                                <table id="clienteTable">
                                    <thead>
                                        <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Identidad</th>
                                        <th>Edad</th>
                                        <th>Estado Civil</th>
                                        <th>Género</th>
                                        <th>Teléfono</th>
                                        <th>Email Personal</th>
                                        <th>Email Laboral</th>
                                        <th>Acciones</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    @foreach($personas as $persona)
                                        <tr>
                                        <td>{{ $persona['id_persona'] }}</td>
                                        <td>{{ $persona['nombres_apellidos'] }}</td>
                                        <td>{{ $persona['n_identidad'] }}</td>
                                        <td>{{ $persona['edad'] }}</td>
                                        <td>{{ $persona['estado_civil'] }}</td>
                                        <td>{{ $persona['genero'] }}</td>
                                        <td>{{ $persona['telefono_secundario'] }}</td>
                                        <td>{{ $persona['email_personal'] }}</td>
                                        <td>{{ $persona['email_laboral'] }}</td>
                                        <td>
                                        <a href="javascript:void(0);" class="btn btn-outline-success btn-sm"
                                        onclick="viewModal({{ json_encode($persona) }})">
                                        <i class="fa fa-eye"></i>
                                        </a>
                                            <a href="{{ route('gestionclientes.show', $persona['id_persona'])}}" class="btn btn-outline-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        <form action="{{ route('gestionclientes.destroy', $persona['id_persona']) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger btn-sm delete-btn">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

<!-- Modal para agregar un nuevo cliente -->
<div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel">Información de Clientes</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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


                        <div class="modal fade" id="nuevoClienteModal" tabindex="-1" aria-labelledby="nuevoClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoClienteModalLabel">Añadir Nuevo Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="nuevoClienteForm" action="{{ route('gestionclientes.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Primera columna -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="nombres_apellidos" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombres_apellidos" name="nombres_apellidos" required>
                            </div>
                            <div class="mb-3">
                                <label for="n_identidad" class="form-label">Número de Identidad</label>
                                <input type="text" class="form-control" id="n_identidad" name="n_identidad" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                            </div>
                            <div class="mb-3">
                                <label for="edad" class="form-label">Edad</label>
                                <input type="number" class="form-control" id="edad" name="edad" required>
                            </div>
                        </div>

                        <!-- Segunda columna -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" required>
                            </div>
                            <div class="mb-3">
                                <label for="estado_civil" class="form-label">Estado Civil</label>
                                <select class="form-control" id="estado_civil" name="estado_civil">
                                    <option value="Soltero">Soltero</option>
                                    <option value="Casado">Casado</option>
                                    <option value="Divorciado">Divorciado</option>
                                    <option value="Viudo">Viudo</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="genero" class="form-label">Género</label>
                                <select class="form-control" id="genero" name="genero">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tipo_persona" class="form-label">Tipo de persona</label>
                                <select class="form-control" id="tipo_persona" name="tipo_persona">
                                    <option value="Solicitante">Solicitante</option>
                                    <option value="Aval">Aval</option>
                                </select>
                            </div>
                        </div>

                        <!-- Tercera columna -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="email_personal" class="form-label">Email Personal</label>
                                <input type="email" class="form-control" id="email_personal" name="email_personal">
                            </div>
                            <div class="mb-3">
                                <label for="email_laboral" class="form-label">Email Laboral</label>
                                <input type="email" class="form-control" id="email_laboral" name="email_laboral">
                            </div>
                            <div class="mb-3">
                                <label for="telefono_secundario" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono_secundario" name="telefono_secundario">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar Cliente</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                    </tbody>
                </table>
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
<script>
   $(document).ready(function () {
        $('#clienteTable').DataTable({
    pageLength: 5,
    responsive: true,
    autoWidth: false,
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json',
        search: "Buscar:",
        lengthMenu: "Mostrar _MENU_ entradas",
        info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
        infoEmpty: "Mostrando 0 a 0 de 0 entradas",
        infoFiltered: "(filtrado de _MAX_ entradas en total)",
        paginate: {
            first: "Primero",
            last: "Último",
            next: "Siguiente",
            previous: "Anterior"
        }
    },
    dom: '<"row d-flex justify-content-between"<"col-md-3"l><"col-md-3 text-end"f>>' +
         '<"row"<"col-md-12"B>>' +
         'rtip',
    buttons: [
        { text: '<i class="fas fa-copy"></i> COPIAR', extend: 'copy', className: 'btn btn-dark' },
      { text: '<i class="fas fa-file-csv"></i> CSV', extend: 'csv', className: 'btn btn-info' },
      { text: '<i class="fas fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-warning' },
      { text: '<i class="fas fa-file-pdf"></i> PDF', extend: 'pdf', className: 'btn btn-danger' },
      { text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-success' },
    ]
});
   });

   
   function viewModal(personas) {
    var modalBody = document.getElementById('viewModalLabel');
    modalBody.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <p><strong>Nombre del cliente:</strong> ${personas.nombres_apellidos}</p>
                <p><strong>Número de identidad:</strong> ${personas.n_identidad || 'No disponible'}</p>
                <p><strong>Fecha de nacimiento:</strong> ${personas.fecha_nacimiento}</p>
                <p><strong>Edad:</strong> ${personas.edad}</p>
                <p><strong>Nacionalidad:</strong> ${personas.nacionalidad || 'No disponible'}</p>
                <p><strong>Estado civil:</strong> ${personas.estado_civil || 'No disponible'}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Género:</strong> ${personas.genero || 'No disponible'}</p>
                <p><strong>Tipo de cliente:</strong> ${personas.tipo_persona}</p>
                <p><strong>Email personal:</strong> ${personas.email_personal}</p>
                <p><strong>Email laboral:</strong> ${personas.email_laboral}</p>
                <p><strong>Teléfono secundario:</strong> ${personas.telefono_secundario}</p>
                <p><strong>Creado en:</strong> ${personas.creado_en ? new Date(personas.creado_en).toLocaleString() : 'No disponible'}</p>
                <p><strong>Modificado por:</strong> ${personas.modificado_por || 'No disponible'}</p>
                <p><strong>Modificado en:</strong> ${personas.modificado_en ? new Date(personas.modificado_en).toLocaleString() : 'No disponible'}</p>
            </div>
        </div>
    `;

    var viewModalElement = new bootstrap.Modal(document.getElementById('view'));
    viewModalElement.show();

}
</script>


@stop

@section('css')

<style>

/*Fondo trasnparente y sin borde en el contenedor*/

    /*Estilo personalizado para los botones*/
    #clienteTable_wrapper .btn {
     
      justify-content: center;/*Centrar los botenes */
      gap: 10px;/*Espaciado entre botenes*/
      margin-bottom: 15px; /*Separar botones de la tabla*/
    }

    #clienteTable_wrapper .dt-buttons .btn {
        min-width: 150px;
        margin-right: 10px;
        border-radius: 4px;
        padding: 5px 15px;
        font-size: 15px;
}
#clienteTable_wrapper {
        width: 96%;
    }
    /*Colores por tipo de botonn*/
    .btn-danger { backgroung-color: #dc3545; border: none; }
    .btn-success { backgroung-color: #28a745; border: none; }
    .btn-info { backgroung-color: #17a2b8; border: none; }
    .btn-warning { backgroung-color: #ffc107; color: #212529; border: none; }
    .btn-default { backgroung-color: #6e7176; color: #212529; border: none; }

#clienteTable_wrapper {
    margin-left: auto;
    width: 96%; /* Ajusta este valor según lo que necesites */
}
    
    .container-fluid {
        width: 100vw;
        height: 100vh;
        padding: 0px;
    }
</style>
@stop
