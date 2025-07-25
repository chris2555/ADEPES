@extends('adminlte::page')

@section('title', 'Parámetros - Listado')

@section('content_header')
    <h1><b>Listado de Parámetros</b></h1>
    <hr>
@stop

@section('content')

    <head>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class='row'>
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Parámetros registrados</h3>

                    <div class="card-tools">
                        <a href="{{ route('Parametros.create') }}" class="btn btn-success"> Crear nuevo parámetro </a>
                    </div>
                    </div>
                <div class="card-body" style="display: block;">
                    <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                        <thead>
                            <tr>
                                <th style="width: 15%;">Clave (ID)</th>
                                <th style="width: 25%;">Valor</th>
                                <th style="width: 30%;">Descripción</th>
                                <th style="width: 15%;">Creado el</th> {{-- Nueva columna --}}
                                <th style="width: 15%;">Última Actualización</th> {{-- Nueva columna --}}
                                <th style="width: 10%;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parametros as $parametro)
                                <tr>
                                    <td style ="word-break: break-all;">{{ $parametro->id }}</td>
                                    <td style ="word-break: break-all;">{{ $parametro->valor }}</td>
                                    <td style ="word-break: break-all;">{{ $parametro->descripcion }}</td>
                                    {{-- Formateando las fechas --}}
                                    <td>{{ $parametro->created_at ? $parametro->created_at->format('d/m/Y H:i:s') : 'N/A' }}</td>
                                    <td>{{ $parametro->updated_at ? $parametro->updated_at->format('d/m/Y H:i:s') : 'N/A' }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Acciones de parámetro">
                                            {{-- Botón Ver --}}
                                            <a href="{{ route('Parametros.show', $parametro->id) }}"
                                                style="margin-right: 5px;" class="btn btn-info btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            {{-- Botón Editar --}}
                                            <a href="{{ route('Parametros.edit', $parametro->id) }}"
                                                style="margin-right: 5px;" class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            {{-- Formulario para "Eliminar" (con SweetAlert2 de acción no permitida) --}}
                                            <form action="{{ route('Parametros.destroy', $parametro->id) }}"
                                                method="post" onclick="denyDelete(event)"
                                                id="form-delete-{{ $parametro->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    style="display:inline;">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
    </div>

@stop

@section('css')
    <style>
        /*Fondo transparente y sin borde en el contenedor*/
        #example1_wrapper .dt-buttons {
            background-color: transparent;
            box-shadow: none;
            border: none;
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        /*Estilo personalizado para los botones*/
        #example1_wrapper .btn {
            color: #fff;
            border-radius: 4px;
            padding: 5px 15px;
            font-size: 14px;
        }

        /*Colores por tipo de botón*/
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
            border: none;
        }

        .btn-default {
            background-color: #6e7176;
            color: #212529;
            border: none;
        }

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
            margin-left: 5px;
        }

        .dataTables_paginate {
            text-align: right !important;
        }

        .dt-buttons {
            margin-bottom: 10px;
        }
    </style>
@stop

@section('js')
    <script src="//cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            $('#example1').DataTable({
                "pageLength": 5,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "language": {
                    "emptyTable": "No hay información disponible de parámetros.",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ parámetros",
                    "infoEmpty": "Mostrando 0 a 0 de 0 parámetros",
                    "infoFiltered": "(Filtrado de _MAX_ total parámetros)",
                    "lengthMenu": "Mostrar _MENU_ parámetros",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron parámetros que coincidan",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                dom: '<"row d-flex justify-content-between"<"col-md-3"l><"col-md-6"><"col-md-3 d-flex justify-content-end"f>>' +
                    '<"row"<"col-md-12"B>>' +
                    'rt' +
                    '<"row d-flex align-items-center mt-2"<"col-md-6 text-start"i><"col-md-6 d-flex justify-content-end"p>>',
                buttons: [{
                        text: '<i class="fas fa-copy"></i> COPIAR',
                        extend: 'copy',
                        className: 'btn btn-info'
                    },
                    {
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        extend: 'csv',
                        className: 'btn btn-info'
                    },
                    {
                        text: '<i class="fas fa-print"></i> IMPRIMIR',
                        extend: 'print',
                        className: 'btn btn-info'
                    },
                    {
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        extend: 'pdf',
                        className: 'btn btn-info'
                    },
                    {
                        text: '<i class="fas fa-file-excel"></i> EXCEL',
                        extend: 'excel',
                        className: 'btn btn-info'
                    },
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        // Función para DENY la eliminación de parámetros
        function denyDelete(event) {
            event.preventDefault(); // Evitar el envío del formulario
            Swal.fire({
                icon: 'warning',
                title: 'Acción no permitida',
                text: 'No está permitido borrar parámetros.',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#3085d6'
            });
        }
    </script>
@stop