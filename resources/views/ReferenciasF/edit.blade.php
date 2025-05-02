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
                            <input type="hidden" name="id_persona" value="{{ $referencias['id_persona'] }}">

                            <!-- Referencias Familiares -->
                            <h5 class="mb-3">Referencias Familiares</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <x-adminlte-input name="nombre_familiar" id="nombre_familiar" label="Nombre del Familiar 1" value="{{ $referencias['nombre_familiar'] }}" required fgroup-class="mb-3" />
                                    <x-adminlte-input name="parentesco" id="parentesco" label="Parentesco" value="{{ $referencias['parentesco'] }}" required fgroup-class="mb-3" />
                                    <x-adminlte-input name="telref1" id="telref1" label="Teléfono Familiar 1" type="text"
                                        value="{{ $referencias['telref1'] }}" fgroup-class="mb-3" required
                                        pattern="[2389][0-9]{7}" maxlength="8"
                                        title="El número debe tener 8 dígitos y comenzar con 2, 3, 8 o 9." />
                                    <x-adminlte-textarea name="direccion_familiar" id="direccion_familiar" label="Dirección" rows="3" fgroup-class="mb-3">{{ $referencias['direccion_familiar'] }}</x-adminlte-textarea>
                                </div>

                                <div class="col-md-6">
                                    <x-adminlte-input name="nombre_familiardos" id="nombre_familiardos" label="Nombre del Familiar 2" value="{{ $referencias['nombre_familiardos'] }}" required fgroup-class="mb-3" />
                                    <x-adminlte-input name="parentesco_dos" id="parentesco_dos" label="Parentesco" value="{{ $referencias['parentesco_dos'] }}" required fgroup-class="mb-3" />
                                    <x-adminlte-input name="telref2" id="telref2" label="Teléfono Familiar 2" type="text"
                                        value="{{ $referencias['telref2'] }}" fgroup-class="mb-3" required
                                        pattern="[2389][0-9]{7}" maxlength="8"
                                        title="El número debe tener 8 dígitos y comenzar con 2, 3, 8 o 9." />
                                    <x-adminlte-textarea name="direccion_familiardos" id="direccion_familiardos" label="Dirección" rows="3" fgroup-class="mb-3">{{ $referencias['direccion_familiardos'] }}</x-adminlte-textarea>
                                </div>
                            </div>

                            <!-- Referencias Personales -->
                            <h5 class="mt-4 mb-3">Referencias Personales</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <x-adminlte-input name="nombreper1" id="nombreper1" label="Nombre Persona 1" value="{{ $referencias['nombreper1'] }}" required fgroup-class="mb-3" />
                                    <x-adminlte-input name="relacionper1" id="relacionper1" label="Relación con Persona 1" value="{{ $referencias['relacionper1'] }}" required fgroup-class="mb-3" />
                                    <x-adminlte-input name="telrefper1" id="telrefper1" label="Teléfono Persona 1" type="text"
                                        value="{{ $referencias['telrefper1'] }}" fgroup-class="mb-3" required
                                        pattern="[2389][0-9]{7}" maxlength="8"
                                        title="El número debe tener 8 dígitos y comenzar con 2, 3, 8 o 9." />
                                    <x-adminlte-textarea name="direccionper1" id="direccionper1" label="Dirección Persona 1" rows="3" fgroup-class="mb-3">{{ $referencias['direccionper1'] }}</x-adminlte-textarea>
                                </div>

                                <div class="col-md-6">
                                    <x-adminlte-input name="nombreper2" id="nombreper2" label="Nombre Persona 2" value="{{ $referencias['nombreper2'] }}" required fgroup-class="mb-3" />
                                    <x-adminlte-input name="relacionper2" id="relacionper2" label="Relación con Persona 2" value="{{ $referencias['relacionper2'] }}" required fgroup-class="mb-3" />
                                    <x-adminlte-input name="telrefper2" id="telrefper2" label="Teléfono Persona 2" type="text"
                                        value="{{ $referencias['telrefper2'] }}" fgroup-class="mb-3" required
                                        pattern="[2389][0-9]{7}" maxlength="8"
                                        title="El número debe tener 8 dígitos y comenzar con 2, 3, 8 o 9." />
                                    <x-adminlte-textarea name="direccionper2" id="direccionper2" label="Dirección Persona 2" rows="3" fgroup-class="mb-3">{{ $referencias['direccionper2'] }}</x-adminlte-textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('referencias.index') }}" class="btn btn-secondary">Cancelar</a>
                            <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar" label="Actualizar Información" theme="success" icon="fas fa-lg fa-save" />
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

@stop