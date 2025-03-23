@extends('adminlte::page')

@section('title', 'Editar InformacionLaboral')

@section('content_header')
    <h1>Editar Informacion Laboral</h1>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Actualizar Informacion Laboral</h3>
                        </div>
                        <form id="editForm" action="{{ route('informacionlaboral.update', $informacionlaboral['id_informacion_laboral']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <!-- Columna Izquierda -->
                                    <div class="col-md-6">
                                        <!-- Profecion u Oficio -->
                                        <x-adminlte-input name="Profecion u Oficio" label="Profecion u Oficio" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['profesion_oficio'] }}" required />

                                            <x-adminlte-input name="Actividad" label="Actividad" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['actividad'] }}" required />

                                            <x-adminlte-input name="Ingresos Negocio" label="Ingresos Negocio" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['ingresos_negocio'] }}" required />

                                            <x-adminlte-input name="Direccion Trabajo" label="Direccion Trabajo" fgroup-class="mb-3"
                                        value="{{ $informacionlaboral['direccion_trabajo'] }}" required />

                                        <x-adminlte-input name="Patrono Negocio" label="Patrono Negocio" fgroup-class="mb-3"
                                        value="{{ $informacionlaboral['patrono_negocio'] }}" required />

                                        
                                    </div>
                                        <!-- Columna Derecha -->
                                    <div class="col-md-6">
                                        <!-- Tipo de Entidad -->
                                        <x-adminlte-input name="Valor de cuota" label="Valor de cuota" fgroup-class="mb-3"
                                           value="{{ $informacionlaboral['valor_cuota'] }}" required />

                                           <x-adminlte-input name="Tiempo de Laborar" label="Tiempo de Laborar" fgroup-class="mb-3"
                                        value="{{ $informacionlaboral['tiempo_laborar'] }}" required />

                                        <x-adminlte-input name="Gastos de alimentacion" label="Gastos de alimentacion" fgroup-class="mb-3"
                                        value="{{ $informacionlaboral['gastos_alimentacion'] }}" required />

                                        <!-- Estado de credito -->
                                      
                                            <option value="Aprobado"
                                                {{ $informacionlaboral['estado_credito'] == 'Aprobado' ? 'selected' : '' }}>
                                                Aprobado</option>
                                            <option value="Pendiente"
                                                {{ $informacionlaboral['estado_credito'] == 'Pendiente' ? 'selected' : '' }}>Pendiente
                                            </option>
                                            <option value="Rechazado"
                                                {{ $informacionlaboral['estado_credito'] == 'Rechazado' ? 'selected' : '' }}>Rechazado
                                            </option>
                                        </x-adminlte-select>

                                        
                                     </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('informacionlaboral.index') }}" class="btn btn-secondary">Cancelar</a>
                                    <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar"
                                        label="Actualizar Informacion Laboral" theme="success" icon="fas fa-lg fa-save" />
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