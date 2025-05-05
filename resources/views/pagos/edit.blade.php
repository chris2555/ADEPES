@extends('adminlte::page')

@section('title', 'Editar Pagos')

@section('content_header')
    <h1><b>Pagos / Modificar Pago</b></h1>
    </hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Llene los datos del formulario</h3>
            </div>
            <div class="card-body">
                <form id="editForm" action="{{ route('pagos.update', $pago->id_pago) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Columna izquierda -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_prestamo" class="form-label">ID del Préstamo</label>
                                <input type="number" class="form-control" id="id_prestamo" name="id_prestamo" value="{{ $pago->id_prestamo }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_persona" class="form-label">ID de la Persona</label>
                                <input type="number" class="form-control" id="id_persona" name="id_persona" value="{{ $pago->id_persona }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="monto" class="form-label">Monto del Pago</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="monto" name="monto" value="{{ $pago->monto }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="metodo_pago" class="form-label">Método de Pago</label>
                                <select class="form-control" id="metodo_pago" name="metodo_pago" required>
                                    <option value="Efectivo" {{ $pago->metodo_pago == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                                    <option value="Transferencia" {{ $pago->metodo_pago == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                                    <option value="Cheque" {{ $pago->metodo_pago == 'Cheque' ? 'selected' : '' }}>Cheque</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="recibo" class="form-label">Número de Recibo</label>
                                <input type="text" class="form-control" id="recibo" name="recibo" value="{{ $pago->recibo }}" required>
                            </div>
                        </div>

                        <!-- Columna derecha -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha de Pago</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $pago->fecha }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="intereses" class="form-label">Intereses</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="intereses" name="intereses" value="{{ $pago->intereses }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Cambios</button>
                        <a href="{{ route('pagos.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    @if (session('error'))
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
