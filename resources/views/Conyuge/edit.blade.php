@extends('adminlte::page')

@section('title', 'Editar infromacion Conyuge')

@section('content_header')
<h1></h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Actualizar Solicitud</h3>
                    </div>
                    <form id="editForm" action="{{ route('conyuge.update', $solicitudes['id_conyuge']) }}" method="POST">

                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <!-- Columna Izquierda -->
                                <div class="col-md-6">
                                    <x-adminlte-input name="nombres_conyuge" label="Nombre del Cónyuge" fgroup-class="mb-3" required
                                        value="{{ old('nombres_conyuge', $solicitudes['nombres_conyuge'] ?? '') }}" />

                                    <x-adminlte-input name="fecha_nacimiento_conyuge" label="Fecha de Nacimiento del Cónyuge"
                                        type="date" fgroup-class="mb-3" class="form-control" id="fecha_nacimiento_conyuge" value="{{ \Carbon\Carbon::parse($solicitudes['fecha_nacimiento_conyuge'])->format('Y-m-d') }}" required/>

                                    <x-adminlte-input name="identidad_conyuge" label="Identidad del Cónyuge"
                                        type="text" fgroup-class="mb-3" required
                                        value="{{ old('identidad_conyuge', $solicitudes['identidad_conyuge'] ?? '') }}" />

                                    <x-adminlte-textarea name="direccion_conyuge" label="Dirección del Cónyuge"
                                        fgroup-class="mb-3" required>
                                        {{ old('direccion_conyuge', $solicitudes['direccion_conyuge'] ?? '') }}
                                    </x-adminlte-textarea>

                                    <x-adminlte-input name="profesion_oficio_conyuge" label="Profesión u Oficio del Cónyuge"
                                        type="text" fgroup-class="mb-3" required
                                        value="{{ old('profesion_oficio_conyuge', $solicitudes['profesion_oficio_conyuge'] ?? '') }}" />

                                    <x-adminlte-input name="cargo_conyuge" label="Cargo del Cónyuge"
                                        type="text" fgroup-class="mb-3" required
                                        value="{{ old('cargo_conyuge', $solicitudes['cargo_conyuge'] ?? '') }}" />
                                </div>

                                <!-- Columna Derecha -->
                                <div class="col-md-6">
                                    <x-adminlte-input name="ingresos_negocio_conyuge" label="Ingresos del Negocio del Cónyuge"
                                        type="number" step="0.01" fgroup-class="mb-3" required
                                        value="{{ old('ingresos_negocio_conyuge', $solicitudes['ingresos_negocio_conyuge'] ?? '') }}" />

                                    <x-adminlte-textarea name="direccion_trabajo_conyuge" label="Dirección de Trabajo del Cónyuge"
                                        fgroup-class="mb-3" required>
                                        {{ old('direccion_trabajo_conyuge', $solicitudes['direccion_trabajo_conyuge'] ?? '') }}
                                    </x-adminlte-textarea>

                                    <x-adminlte-select name="tipo_cliente" label="Tipo de Cliente" fgroup-class="mb-3" required>
                                        <option value="">Seleccione un Tipo</option>
                                        <option value="Activo" {{ old('tipo_cliente', $solicitudes['tipo_cliente'] ?? '') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="Inactivo" {{ old('tipo_cliente', $solicitudes['tipo_cliente'] ?? '') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                        <option value="Primera vez" {{ old('tipo_cliente', $solicitudes['tipo_cliente'] ?? '') == 'Primera vez' ? 'selected' : '' }}>Primera vez</option>
                                    </x-adminlte-select>

                                    <x-adminlte-select name="tiempo_laborar_conyuge" label="Tiempo de Laborar del Cónyuge" fgroup-class="mb-3" required>
                                        <option value="">Seleccione un Tiempo</option>
                                        <option value="1 año" {{ old('tiempo_laborar_conyuge', $solicitudes['tiempo_laborar_conyuge'] ?? '') == '1 año' ? 'selected' : '' }}>1 año</option>
                                        <option value="2 años" {{ old('tiempo_laborar_conyuge', $solicitudes['tiempo_laborar_conyuge'] ?? '') == '2 años' ? 'selected' : '' }}>2 años</option>
                                        <option value="3 años" {{ old('tiempo_laborar_conyuge', $solicitudes['tiempo_laborar_conyuge'] ?? '') == '3 años' ? 'selected' : '' }}>3 años</option>
                                        <option value="4 años" {{ old('tiempo_laborar_conyuge', $solicitudes['tiempo_laborar_conyuge'] ?? '') == '4 años' ? 'selected' : '' }}>4 años</option>
                                        <option value="Más de 5 años" {{ old('tiempo_laborar_conyuge', $solicitudes['tiempo_laborar_conyuge'] ?? '') == 'Más de 5 años' ? 'selected' : '' }}>Más de 5 años</option>
                                    </x-adminlte-select>

                                    <x-adminlte-input name="gastos_alimentacion_conyuge" label="Gastos de Alimentación del Cónyuge"
                                        type="number" step="0.01" fgroup-class="mb-3" required
                                        value="{{ old('gastos_alimentacion_conyuge', $solicitudes['gastos_alimentacion_conyuge'] ?? '') }}" />

                                    <x-adminlte-input name="estado_credito_conyuge" label="Estado de Crédito del Cónyuge"
                                        type="text" fgroup-class="mb-3" required
                                        value="{{ old('estado_credito_conyuge', $solicitudes['estado_credito_conyuge'] ?? '') }}" />

                                        <x-adminlte-input name="telefono_conyuge" label="Telefono del Cónyuge"
                                        type="text" fgroup-class="mb-3" required
                                        value="{{ old('telefono_conyuge', $solicitudes['telefono_conyuge'] ?? '') }}" />
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('conyuge.index') }}" class="btn btn-secondary">Cancelar</a>
                            <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar" label="Actualizar Información" theme="success" icon="fas fa-lg fa-save" />
                        </div>
</section>

@stop

@section('css')

@stop

@section('js')

@stop