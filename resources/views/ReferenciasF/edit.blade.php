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

                    <form id="editForm" action="{{ route('referencias.update', $referencias['id_referencia']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <!-- ID de Referencia (readonly) -->
                                <input type="hidden" name="id_persona" value="{{ $referencias['id_persona'] }}">
                                <!-- Nombre del Familiar -->
                                <div class="col-md-6">
                                    <x-adminlte-input name="nombre_familiar" id="nombre_familiar" label="Nombre del Familiar" value="{{ $referencias['nombre_familiar'] }}" required fgroup-class="mb-3" />
                                </div>

                                <!-- Parentesco -->
                                <div class="col-md-6">
                                    <x-adminlte-input name="parentesco" id="parentesco" label="Parentesco" value="{{ $referencias['parentesco'] }}" fgroup-class="mb-3" />
                                </div>
                            </div>

                            <div class="row">
                                <!-- Dirección -->
                                <div class="col-md-12">
                                    <x-adminlte-textarea name="direccion_familiar" id="direccion_familiar" label="Dirección" fgroup-class="mb-3" rows="3">{{ $referencias['direccion_familiar'] }}</x-adminlte-textarea>
                                </div>
                            
                            <div class="col-md-6">
                                    <x-adminlte-input name="nombre_familiardos" id="nombre_familiardos" label="Nombre del Familiar" value="{{ $referencias['nombre_familiardos'] }}" required fgroup-class="mb-3" />
                                </div>

                                <!-- Parentesco -->
                                <div class="col-md-6">
                                    <x-adminlte-input name="parentesco_dos" id="parentesco_dos" label="Parentesco" value="{{ $referencias['parentesco_dos'] }}" fgroup-class="mb-3" />
                                </div>
                            </div>

                            <div class="row">
                                <!-- Dirección -->
                                <div class="col-md-12">
                                    <x-adminlte-textarea name="direccion_familiardos" id="direccion_familiardos" label="Dirección" fgroup-class="mb-3" rows="3">{{ $referencias['direccion_familiardos'] }}</x-adminlte-textarea>
                                    </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('referencias.index') }}" class="btn btn-secondary">Cancelar</a>
                            <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar" label="Actualizar Información" theme="success" icon="fas fa-lg fa-save" />
                        </div>
</section>
@stop

@section('css')

@stop

@section('js')

@stop