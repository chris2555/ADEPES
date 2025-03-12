
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
                            <h3 class="card-title">Actualizar Pagos</h3>
                        </div>
                        <form id="editForm" action="{{ route('pagos.update', $pagos['ID_Pago']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <!-- Columna Izquierda -->
                                    <div class="col-md-6">
                                        <!-- Fecha de Pago -->
                                        <x-adminlte-input name="Fecha_De_Pago" label="Fecha de Pago" fgroup-class="mb-3"
                                            value="{{ $pago['Fecha_De_Pago'] }}" required />

                                        <!-- Nombre Completo -->
                                        <x-adminlte-select name="Nombre_Completo" label="Nombre Completo" fgroup-class="mb-3" required>
                                            <option value="{{ $pago['Nombre_Completo'] }}" selected>{{ $pago['Nombre_Completo'] }}</option>
                                        </x-adminlte-select>

                                        <!-- Pago Capital -->
                                        <x-adminlte-select name="Pago_Capital" label="Pago Capital" fgroup-class="mb-3" required>
                                            <option value="{{ $pago['Pago_Capital'] }}" selected>{{ $pago['Pago_Capital'] }}</option>
                                        </x-adminlte-select>

                                        <!-- Intereses Pagados -->
                                        <x-adminlte-select name="Intereses_Pagados" label="Intereses Pagados" fgroup-class="mb-3" required>
                                            <option value="{{ $pago['Intereses_Pagados'] }}" selected>{{ $pago['Intereses_Pagados'] }}</option>
                                        </x-adminlte-select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('pagos.pagos') }}" class="btn btn-secondary">Cancelar</a>
                                    <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar"
                                        label="Actualizar Pagos" theme="success" icon="fas fa-lg fa-save" />
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




