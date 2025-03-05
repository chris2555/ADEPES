@extends('adminlte::page')

@section('title', 'Parametros')
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
            <h4 class="mb-0"><i class="fas fa-users"></i> Parametros</h4>
            
        </div>

<!-- Botón "Nuevo" más arriba -->
<div class="d-flex justify-content-end mb-3">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoparametroModal">
        <i class="fas fa-plus"></i> Nuevo
</div>

<!-- Contenedor de la tabla alineada a la derecha -->
<div class="d-flex justify-content-end">
    <div class="table-responsive ms-auto">
        <table id="parametroTable">
                    <thead class="">
                        <tr>
                            <th>Id_parametros</th>
                            <th>tipo_usuario</th>
                            <th>clave</th>
                            <th>nombre_usuario</th>
                            <th>creado_en</th>
                            <th>actualizado_en</th>
                            <th>intento_ingreso</th>
                            <th>vencimiento_usuario</th>
                            <th>descripcion</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($parametros as $parametro)
                            <tr>
                                <td>{{ $parametro['id_parametro'] }}</td>
                                <td>{{ $parametro['tipo_usuario'] }}</td>
                                <td>{{ $parametro['clave'] }}</td>
                                <td>{{ $parametro['nombre_usuario'] }}</td>
                                <td>{{ $parametro['creado_en'] }}</td>
                                <td>{{ $parametro['actualizado_en'] }}</td>
                                <td>{{ $parametro['intento_ingreso'] }}</td>
                                <td>{{ $parametro['vencimiento_usuario'] }}</td>
                                <td>{{ $parametro['descripcion'] }}</td>
                                <td>
                                <a href="javascript:void(0);" class="btn btn-success btn-sm" onclick="viewModal({{ json_encode($parametro) }})">
                        <i class="fa fa-eye"></i>
                    </a>
                                    <a href="{{ route('Parametros.edit', $parametro['id_parametro']) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('Parametros.destroy', $parametro['id_parametro']) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-warning btn-sm" onclick="return confirm('¿Está seguro de eliminar este Parametro?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
<!-- Modal para agregar un nuevo cliente -->
<div class="modal fade" id="nuevoparametroModal" tabindex="-1" aria-labelledby="nuevoparametroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- modal-lg para hacerlo más ancho -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoparametroModalLabel">Agregar Nuevo parametro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="nuevoparametroForm">
                    <div class="row">
                        <!-- Primera columna -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombres_apellidos" class="form-label">intento ingreso</label>
                                <input type="text" class="form-control" id="nombres_apellidos" name="nombres_apellidos" required>
                            </div>
                            <div class="mb-3">
                                <label for="n_identidad" class="form-label">Nombre de usuario</label>
                                <input type="text" class="form-control" id="n_identidad" name="n_identidad" required>
                            </div>
                            <div class="mb-3">
                                <label for="edad" class="form-label">Descripcion</label>
                                <input type="number" class="form-control" id="edad" name="edad" required>
                            </div>
                            <div class="mb-3">
                                <label for="estado_civil" class="form-label">Tipo de usuario</label>
                                <select class="form-control" id="estado_civil" name="estado_civil">
                                    <option value="Administrador">Administrador</option>
                                    <option value="Contador">Contador</option>
                                    <option value="Tecnico">Tecnico</option>
                                    
                                </select>
                            </div>
                        </div>

                        <!-- Segunda columna -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="genero" class="form-label">Creado en </label>
                                <input type="number" class="form-control" id="edad" name="edad" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefono_secundario" class="form-label">Actualizado en </label>
                                <input type="text" class="form-control" id="telefono_secundario" name="telefono_secundario">
                            </div>
                            <div class="mb-3">
                                <label for="email_personal" class="form-label">Clave</label>
                                <input type="email" class="form-control" id="email_personal" name="email_personal">
                            </div>
                            <div class="mb-3">
                                <label for="email_laboral" class="form-label">Id Parametro</label>
                                <input type="email" class="form-control" id="email_laboral" name="email_laboral">
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
        $('#parametroTable').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json',
            search: "Buscar:" // Aquí cambiamos "Search" por "Buscar"
        },
            dom: '<"row d-flex justify-content-between align-items-center"<"col-md-3"l><"col-md-6"B><"col-md-3 text-end"f>>rtip',
            buttons: [
                { extend: 'copy', text: '<i class="fas fa-copy"></i> Copiar', className: 'btn btn-secondary text-dark' },
                { extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', className: 'btn btn-success text-dark' },
                { extend: 'pdf', text: '<i class="fas fa-file-pdf"></i> PDF', className: 'btn btn-danger text-dark' },
                { extend: 'csv', text: '<i class="fas fa-file-csv"></i> CSV', className: 'btn btn-info text-dark' }
            ]
        });
    });

</script>
@stop

@section('css')

<style>


#parametroTable_wrapper {
    margin-left: auto;
    width: 96%; /* Ajusta este valor según lo que necesites */
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
 


