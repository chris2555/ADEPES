@extends('adminlte::page')

@section('title', 'Editar Pagos')

@section('content_header')
    <h1>Editar Pagos</h1>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Actualizar Pago</h3>
                        </div>
                        <form id="editForm" action="{{ route('pagos.update', $pago->id_pago) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <!-- Columna Izquierda -->
                                    <div class="col-md-6">
                                        <!-- ID del Préstamo -->
                                        <x-adminlte-input name="id_prestamo" label="ID del Préstamo" type="number" fgroup-class="mb-3" value="{{ $pago->id_prestamo }}" required />

                                        <!-- ID de la Persona -->
                                        <x-adminlte-input name="id_persona" label="ID de la Persona" type="number" fgroup-class="mb-3" value="{{ $pago->id_persona }}" required />

                                        <!-- Monto del Pago -->
                                        <x-adminlte-input name="monto" label="Monto del Pago" type="number" step="0.01" min="0" fgroup-class="mb-3" value="{{ $pago->monto }}" required />

                                        <!-- Método de Pago -->
                                        <x-adminlte-select name="metodo_pago" label="Método de Pago" fgroup-class="mb-3" required>
                                            <option value="Efectivo" {{ $pago->metodo_pago == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                                            <option value="Transferencia" {{ $pago->metodo_pago == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                                            <option value="Cheque" {{ $pago->metodo_pago == 'Cheque' ? 'selected' : '' }}>Cheque</option>
                                        </x-adminlte-select>

                                        <!-- Número de Recibo -->
                                        <x-adminlte-input name="recibo" label="Número de Recibo" type="text" fgroup-class="mb-3" value="{{ $pago->recibo }}" required />
                                    </div>

                                    <!-- Columna Derecha -->
                                    <div class="col-md-6">
                                        <!-- Fecha de Pago -->
                                        <x-adminlte-input name="fecha" label="Fecha de Pago" type="date" fgroup-class="mb-3" value="{{ $pago->fecha }}" required />

                                        <!-- Intereses -->
                                        <x-adminlte-input name="intereses" label="Intereses" type="number" step="0.01" min="0" fgroup-class="mb-3" value="{{ $pago->intereses }}" required />
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <a href="{{ route('pagos.index') }}" class="btn btn-secondary">Cancelar</a>
                                    <x-adminlte-button class="btn-flat" type="submit" label="Actualizar Pago" theme="success" icon="fas fa-lg fa-save" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
