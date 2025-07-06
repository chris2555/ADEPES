@extends('adminlte::page')
@section('title', 'Configuraciones - Creando nueva configuracion')

@section('content_header')
    <h1><b>Configuraciones/registro de una nueva configuracion</b></h1>
    </hr>
@stop

@section('content')
    <div class='row'>
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Llene los datos del formulario</h3>
            </div>
            <div class="card-body">
                <form action="{{url('configuraciones/create')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4"> <div class="form-group">
                                        <label for="nombre">Nombre de la institución (*)</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escriba aqui..." required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo letras y espacios">
                                        </div>
                                        @error('nombre')
                                        <small style="color: red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción de la institución (*)</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-university"></i></span>
                                            </div>
                                            <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Escriba aqui..." required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo letras y espacios">
                                        </div>
                                        @error('descripcion')
                                        <small style="color: red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4"> <div class="form-group">
                                        <label for="direccion">Dirección (*)</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marked"></i></span>
                                            </div>
                                            <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Escriba aqui..." required>
                                        </div>
                                        @error('direccion')
                                        <small style="color: red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"> <div class="form-group">
                                        <label for="telefono">Teléfono (*)</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Escriba aqui..." required pattern="[0-9]+" title="Solo números">
                                        </div>
                                        @error('telefono')
                                        <small style="color: red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4"> <div class="form-group">
                                        <label for="email">Email</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Escriba aqui...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4"> <div class="form-group">
                                        <label for="web">Página web</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-pager"></i></span>
                                            </div>
                                            <input type="text" name="web" id="web" class="form-control" placeholder="Escriba aqui...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"> <div class="form-group">
                                        <label for="moneda">Moneda (*)</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                            </div>
                                            <select name="moneda" id="moneda" class="form-control" required>
                                                <option value="">-- Seleccione una moneda --</option> <option value="usd">Dolar Estadounidense (USD)</option>
                                                <option value="eur">Euro (EUR)</option> <option value="mxn">Peso Mexicano (MXN)</option>
                                                <option value="hnl">Lempira Hondureño (HNL)</option>
                                            </select>
                                        </div>
                                        @error('moneda')
                                        <small style="color: red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4"> <div class="form-group">
                                        <label for="cartera">Cartera</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                            </div>
                                            <input type="text" name="cartera" id="cartera" class="form-control" placeholder="Ingrese el valor de la cartera" pattern="[0-9]+" title="Solo números">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="file">Logo(*)</label>
                                <input type="file" id="file" name="logo" accept=".jpg, .jpeg, .png" class="form-control" required>
                                @error('logo')
                                <small style="color: red">{{$message}}</small> @enderror
                                <br>
                                <center>
                                    <output id="List"></output> </center>
                                <script>
                                    function archivo(evt) {
                                        var files = evt.target.files; // Obtiene los archivos seleccionados

                                        // Itera sobre los archivos (aunque solo esperamos uno para el logo)
                                        for (var i = 0, f; f = files[i]; i++) {

                                            // Verifica que el archivo sea una imagen
                                            if (!f.type.match('image.*')) {
                                                continue; // Si no es imagen, salta al siguiente archivo
                                            }

                                            var reader = new FileReader(); // Crea un lector de archivos

                                            // Configura la función que se ejecutará cuando el archivo se lea
                                            reader.onload = (function (theFile) {
                                                return function (e) {
                                                    // Actualiza el contenido del elemento con id "List" con la imagen de vista previa
                                                    document.getElementById("List").innerHTML = `<img class="thumb thumbnail" src="${e.target.result}" width="100%" title="${escape(theFile.name)}" alt="Vista previa del logo"/>`; // Ajustado width y añadido alt text
                                                };
                                            })(f);

                                            // Lee el archivo como una URL de datos (para mostrar la vista previa)
                                            reader.readAsDataURL(f);
                                        }
                                    }
                                    // Asigna la función 'archivo' al evento 'change' del input con id 'file'
                                    document.getElementById('file').addEventListener('change', archivo, false);
                                </script>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{url('/configuraciones')}}" class="btn btn-dark">Cancelar</a>
                                <button type="submit" class="btn btn-success">Registrar</button>
                            </div>
                        </div>
                    </div>
                </form> </div>
        </div>
    </div>
</div>

            

@stop

@section('css')
  <style>
    /*Fondo trasnparente y sin borde en el contenedor*/
    #example1_wrapper .dt-buttons {
      background-color: transparent;
      box-shadow: none;
      border: none;
      display: flex;
      justify-content: center;/*Centrar los botenes */
      gap: 10px;/*Espaciado entre botenes*/
      margin-bottom: 15px; /*Separar botones de la tabla*/
    }

    /*Estilo personalizado para los botones*/
    #example1_wrapper .btn {
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

  </style>
@stop

@section('js')
<script>
  $(function () {
   $('#example1').DataTable({
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
      { text: '<i class="fas fa-copy"></i> COPIAR', extend: 'copy', className: 'btn btn-dark' },
      { text: '<i class="fas fa-file-csv"></i> CSV', extend: 'csv', className: 'btn btn-info' },
      { text: '<i class="fas fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-warning' },
      { text: '<i class="fas fa-file-pdf"></i> PDF', extend: 'pdf', className: 'btn btn-danger' },
      { text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-success' },
    ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
   });

   </script>
   @stop
