@extends('adminlte::page')

@section('title', 'Configuraciones - Configuraciones')



@section('content_header')
    <h1><b>Listado de Configuraciones</b></h1>
    </hr>
@stop


@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
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
                            <th style="...">Nro</th>
                            <th style="...">Nombre</th>
                            <th style="...">Descripcion</th>
                            <th style="...">Telefono</th>
                            <th style="...">Email</th>
                            <th style="...">Moneda</th>
                            <th style="...">Logo</th>
                            <th style="...">Accion</th>
                        </tr>
                    </thead>
                <tbody>
              @foreach($configuraciones as $configuracione)
            <tr>
                <td style ="...">{{$configuracione->id}}</td>
                <td>{{$configuracione->nombre}}</td>
                <td>{{$configuracione->descripcion}}</td>
                <td style="text-align: center">{{$configuracione->telefono}}</td>
                <td>{{$configuracione->email}}</td>
                <td style="text-align: center">{{$configuracione->moneda}}</td>
                <td style="text-align: center">
                  <img src="{{asset('storage/'.$configuracione->logo)}}" width="100px" alt="imagen">
                </td>
              <td style="text-align: center">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{url('/configuraciones', $configuracione->id)}}" style="margin-right: 5px;" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                    <a href="{{url('/configuraciones/'.$configuracione->id.'/edit')}}" style="margin-right: 5px;" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                  <form action = "{{url('/configuraciones', $configuracione->id)}}" method="post"
                      onclick="preguntar{{$configuracione->id}}(event)" id="miFormulario{{$configuracione->id}}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" style="display:inline;"><i class="bi bi-trash"></i></button>
                  </form>
                  <script>
                      function preguntar{{$configuracione->id}}(event) {
                        event.preventDefault();
                        Swal.fire({
                          title: 'Desea eliminar este registro?',
                          text: '',
                          icon: 'question',
                          showDenyButton: true,
                          confirmButtonText: 'Eliminar',
                          confirmButtonColor: '#a5161d',
                          denyButtonColor: '#270a0a',
                          debyButtonText: 'Cancelar',
                        }).then((result) => {
                          if (result.isConfirmed) {
                            var form = $('#miFormulario{{$configuracione->id}}');
                            form.submit();
                          }
                        });
                      }
                      </script>
                    </div>
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

    .dataTables_wrapper .dt-buttons {
        background-color: transparent;
        border: none;
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #212529;
        margin-left: 5px; /* Mueve el botón de editar a la derecha */
    }

    .dataTables_paginate {
        text-align: right !important; /* Alinea la paginación a la derecha */
    }

    .dt-buttons {
        margin-bottom: 10px; /* Agrega separación a los botones de impresión */
    }
  </style>
@stop

@section('js')
<!-- DataTables -->
<script src="//cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(function () {
   $('#example1').DataTable({
    "pageLength": 5,
    "responsive": true,
    "lengthChange": true,
    "autoWidth": false,
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
   
    dom: '<"row d-flex justify-content-between"<"col-md-3"l><"col-md-6"><"col-md-3 d-flex justify-content-end"f>>' + 
         '<"row"<"col-md-12"B>>' +
         'rt' +
         '<"row d-flex align-items-center mt-2"<"col-md-6 text-start"i><"col-md-6 d-flex justify-content-end"p>>',
         
            buttons: [
                { text: '<i class="fas fa-copy"></i> COPIAR', extend: 'copy', className: 'btn btn-info' },
                { text: '<i class="fas fa-file-csv"></i> CSV', extend: 'csv', className: 'btn btn-info' },
                { text: '<i class="fas fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-info' },
                { text: '<i class="fas fa-file-pdf"></i> PDF', extend: 'pdf', className: 'btn btn-info' },
                { text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-info' },
                ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
   });


   </script>
@stop