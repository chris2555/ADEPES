@extends('adminlte::page')
@section('title', 'Configuraciones - Creando nueva configuracion')

@section('content_header')
    <h1><b>Configuraciones/Datos Registrados</b></h1>
    </hr>
@stop

@section('content')
    <div class='row'> 
    <div class="col-md-12">
            <div class="card card-outline card-success">
              <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
                
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nombre de la institucion</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                </div>
                                                <input type="text" class="form-control" value="{{$configuraciones->nombre}}" name="nombre" placeholder="Escriba aqui..." disabled>
                                            </div>
                                            @error('nombre')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Descripcion de la institucion</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-university"></i></span>
                                            </div>
                                        <input type="text" value="{{$configuraciones->descripcion}}" name="descripcion" class="form-control" placeholder="Escriba aqui..." disabled>
                                    </div>
                                    @error('descripcion')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Direccion</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marked"></i></span>
                                        </div>
                                        <input type="text" value="{{$configuraciones->direccion}}" name="direccion" class="form-control" placeholder="Escriba aqui..." disabled>
                                    </div>
                                    @error('direccion')
                                        <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                            <label for="">Telefono</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                        <input type="text" value="{{$configuraciones->telefono}}" name="telefono" class="form-control" placeholder="Escriba aqui..." disabled>
                                    </div>
                                    @error('telefono')
                                        <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                            <label for="">Email</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                        <input type="email" value="{{$configuraciones->email}}" name="email" class="form-control" placeholder="Escriba aqui..." disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                            <label for="">Pagina web</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pager"></i></span>
                                            </div>
                                        <input type="text" value="{{$configuraciones->web}}" name="web" class="form-control" placeholder="Escriba aqui..." disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                            <label for="">Moneda</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                            </div>
                                       <select  name="moneda" id="" class="form-control" disabled>
                                       <option value="{{$configuraciones->moneda}}">{{$configuraciones->moneda}}</option>
                                    </select>
                                </div>
                            </div>
                                <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cartera">Cartera</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                        </div>
                                        <select name="cartera" id="cartera" class="form-control" disabled>
                                            <option value="{{$configuraciones->cartera}}">{{$configuraciones->cartera}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="logo"></label>
                        <img src="{{asset('storage/'.$configuraciones->logo)}}" width="100px" alt="imagen">
                        </div>
                    </div>
                </div>
                <hr>
                <div class =  "row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <a href="{{url('/configuraciones')}}" class="btn btn-dark">Volver</a>
                    </div>
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
