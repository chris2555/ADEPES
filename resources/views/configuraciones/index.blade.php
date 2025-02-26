@extends('adminlte::page')

@section('title', 'Configuraciones - Configuraciones')

@section('content_header')
    <h1><b>Listado de Configuraciones</b></h1>
    </hr>
@stop

@section('content')
    <div class='row'> 
    <div class="col-md-12">
            <div class="card card-outline card-success">
              <div class="card-header">
                <h3 class="card-title">Configuraciones registrados</h3>

                <div class="card-tools">
                  <a href="{{url('configuraciones/create')}}" class="btn btn-success"> Crear nuevo </a>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="display: block;">
                <table id="example1" class="table table-bordered table-hover table-striped table-sm" >
                    <thead>
                        <tr>
                            <th style="text-align: center">Nro</th>
                            <th style="text-align: center">Nombre</th>
                            <th style="text-align: center">Descripcion</th>
                            <th style="text-align: center">Telefono</th>
                            <th style="text-align: center">E-mail</th>
                            <th style="text-align: center">Moneda</th>
                            <th style="text-align: center">Logo</th>
                            <th style="text-align: center">Web</th>
                            <th style="text-align: center">Direccion</th>
                            <th style="text-align: center">Accion</th>
                           
                            
                            
                        
                        </tr>
                    </thead>
                <tbody>
              @foreach($configuraciones as $configuracione)
            <tr>
                <td style ="text-align: center">{{$configuracione->id}}</td>
                <td>{{$configuracione->nombre}}</td>
                <td>{{$configuracione->descripcion}}</td>
                <td>{{$configuracione->telefono}}</td>
                <td>{{$configuracione->email}}</td>
                <td>{{$configuracione->moneda}}</td>
                <td>{{$configuracione->logo}}</td>
              <td>

              </td>
            </tr>

        @endforeach
        </tbody>
      </table>
    </div>
              <!-- /.card-body -->
  </div>
            <!-- /.card -->
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

