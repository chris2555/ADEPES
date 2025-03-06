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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert">
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
                                    <button type="button" class="btn btn-outline-warning btn-sm delete-btn">
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
</div>


@include('referencias.modal_create')
@include('referencias.modal_view')

@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#referenciasTable').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json'
            }
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
