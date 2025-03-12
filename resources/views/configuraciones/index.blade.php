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
                    <a href="{{url('/configuraciones', $configuracione->id)}}" style="border-radius: 4px 0px 0px 4px" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                    <a href="{{url('/configuraciones/'.$configuracione->id.'/edit')}}" style="border-radius: 0px 0px 0px 0px" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
                  <form action = "{{url('/configuraciones', $configuracione->id)}}" method="post"
                      onclick="preguntar{{$configuracione->id}}(event)" id="miFormulario{{$configuracione->id}}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 4px  4px 0px"><i class="fas fa-trash"></i></button>
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

  </style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

