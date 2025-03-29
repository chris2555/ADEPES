@extends('adminlte::page')

@section('title', 'Editar Información Laboral')

@section('content_header')
    <h1>Editar Información Laboral</h1>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Actualizar Información Laboral</h3>
                        </div>
                        <form id="editForm" action="{{ route('informacionlaboral.update', $informacionlaboral['id_informacion_laboral']) }}" method="POST">
                        @csrf
                         @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <!-- Columna Izquierda -->
                                    <div class="col-md-6">
                                        <x-adminlte-input name="profesion_oficio" label="Profesión u Oficio" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['profesion_oficio'] ?? '' }}" required />

                                        <x-adminlte-input name="actividad" label="Actividad" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['actividad'] ?? '' }}" required />

                                        <x-adminlte-input name="ingresos_negocio" label="Ingresos Negocio" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['ingresos_negocio'] ?? '' }}" required />

                                        <x-adminlte-input name="direccion_trabajo" label="Dirección Trabajo" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['direccion_trabajo'] ?? '' }}" required />

                                        <x-adminlte-input name="patrono_negocio" label="Patrono Negocio" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['patrono_negocio'] ?? '' }}" required />
                                    </div>
                                    <!-- Columna Derecha -->
                                    <div class="col-md-6">
                                        <x-adminlte-input name="valor_cuota" label="Valor de Cuota" fgroup-class="mb-3"
                                           value="{{ $informacionlaboral['valor_cuota'] ?? '' }}" required />

                                        <x-adminlte-input name="tiempo_laborar" label="Tiempo de Laborar" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['tiempo_laborar'] ?? '' }}" required />

                                        <x-adminlte-input name="gastos_alimentacion" label="Gastos de Alimentación" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['gastos_alimentacion'] ?? '' }}" required />

                                        <x-adminlte-select name="estado_credito" label="Estado de Crédito" fgroup-class="mb-3">
                                            <option value="Aprobado" {{ $informacionlaboral['estado_credito'] == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
                                            <option value="Pendiente" {{ $informacionlaboral['estado_credito'] == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                            <option value="Rechazado" {{ $informacionlaboral['estado_credito'] == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                                        </x-adminlte-select>
                                    </div>
                                </div>
                            </div> <!-- Fin de card-body -->

                            <div class="card-footer">
                                <a href="{{ route('informacionlaboral.index') }}" class="btn btn-secondary">Cancelar</a>
                                <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar"
                                    label="Actualizar Información Laboral" theme="success" icon="fas fa-lg fa-save" />
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