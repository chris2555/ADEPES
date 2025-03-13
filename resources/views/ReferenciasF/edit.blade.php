@extends('adminlte::page')

@section('title', 'Editar Referencia Familiar')
@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1>Editar Referencia Familiar</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Actualizar Información</h3>
                    </div>

                    <form id="editForm" action="{{ route('referencias.update', $referencia['id_referencia']) }}" method="POST" onsubmit="reloadAfterSubmit(event)">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <!-- ID de Referencia (readonly) -->
                                <div class="col-md-6">
                                    <x-adminlte-input name="id_referencia" label="ID de Referencia" value="{{ $referencia['id_referencia'] }}" readonly fgroup-class="mb-3" />
                                </div>

                                <!-- ID de Solicitud -->
                                <div class="col-md-6">
                                    <x-adminlte-input name="id_solicitud" label="ID de Solicitud" value="{{ $referencia['id_solicitud'] }}" required fgroup-class="mb-3" readonly />
                                </div>
                            </div>

                            <div class="row">
                                <!-- Nombre del Familiar -->
                                <div class="col-md-6">
                                    <x-adminlte-input name="nombre_familiar" label="Nombre del Familiar" value="{{ $referencia['nombre_familiar'] }}" required fgroup-class="mb-3" />
                                </div>

                                <!-- Parentesco -->
                                <div class="col-md-6">
                                    <x-adminlte-input name="parentesco" label="Parentesco" value="{{ $referencia['parentesco'] }}" fgroup-class="mb-3" />
                                </div>
                            </div>

                            <div class="row">
                                <!-- Dirección -->
                                <div class="col-md-12">
                                    <x-adminlte-textarea name="direccion_familiar" label="Dirección" fgroup-class="mb-3" rows="3">{{ $referencia['direccion_familiar'] }}</x-adminlte-textarea>
                                </div>
                            </div>

                            <!-- Usuario Modificador -->
                            <input type="hidden" name="modificado_por" value="{{ auth()->user()->id }}">
                        </div>

                        <!-- Botones bien alineados -->
                        <div class="card-footer d-flex justify-content-end gap-2">
                            <a href="{{ route('referencias.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar" label="Actualizar Referencia" theme="success" icon="fas fa-lg fa-save" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function reloadAfterSubmit(event) {
        event.preventDefault(); // Evita la recarga inmediata
        let form = event.target;

        fetch(form.action, {
            method: form.method,
            body: new FormData(form),
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                "Accept": "application/json"  // Asegura que Laravel responda en JSON
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Referencia actualizada',
                    text: 'Redirigiendo...',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "{{ route('referencias.index') }}"; // Redirigir a index
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.error || 'No se pudo actualizar la referencia',
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema con la actualización'
            });
        });
    }

    document.getElementById('editForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío del formulario

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, actualizar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, envía el formulario
                reloadAfterSubmit(event);
            }
        });
    });
</script>

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif
@stop