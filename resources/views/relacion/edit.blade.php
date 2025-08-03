@extends('adminlte::page')

@section('title', 'Editar Relacion')

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
                        <h3 class="card-title">Actualizar Relación</h3>
                    </div>
                    <form id="editForm" action="{{ route('relacion.update', $relacion->id_relacion) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <!-- Mostrar solicitud como campo deshabilitado -->
<x-adminlte-select name="id_solicitud_disabled" label="Solicitud" fgroup-class="mb-3" disabled>
    <option selected>
        ID: {{ $relacion->id_solicitud }} - Monto: L 
        {{ number_format(optional($solicitudes->firstWhere('id_solicitud', $relacion->id_solicitud))->monto ?? 0, 2) }}
    </option>
</x-adminlte-select>

<!-- Campo oculto para enviar el valor real -->
<input type="hidden" name="id_solicitud" value="{{ $relacion->id_solicitud }}">


                            <div class="row">
                                <!-- Columna Izquierda -->
                                <div class="col-md-6">
                                    <!-- Persona -->
                                    <x-adminlte-select name="id_persona_disabled" label="Persona" fgroup-class="mb-3" disabled>
    <option selected>
        {{ optional($personas->firstWhere('id_persona', $relacion->id_persona))->nombres_apellidos ?? '' }} - 
        {{ optional($personas->firstWhere('id_persona', $relacion->id_persona))->n_identidad ?? '' }}
    </option>
</x-adminlte-select>
<input type="hidden" name="id_persona" value="{{ $relacion->id_persona }}">

<!-- Conyuge -->

                                    <x-adminlte-select name="id_conyuge_disabled" label="Cónyuge" fgroup-class="mb-3" disabled>
    <option selected>
        {{ optional($conyuges->firstWhere('id_conyuge', $relacion->id_conyuge))->nombres_conyuge ?? '' }} - 
        {{ optional($conyuges->firstWhere('id_conyuge', $relacion->id_conyuge))->identidad_conyuge ?? '' }}
    </option>
</x-adminlte-select>
<input type="hidden" name="id_conyuge" value="{{ $relacion->id_conyuge }}">


                                    <!-- Ingresos -->
                                    <x-adminlte-select name="id_ingresos_disabled" label="Ingreso" fgroup-class="mb-3" disabled>
    <option selected>
        ID: {{ $relacion->id_ingresos }} - L 
        {{ number_format(optional($ingresos->firstWhere('id_ingresos', $relacion->id_ingresos))->total_ingresos ?? 0, 2) }}
    </option>
</x-adminlte-select>
<input type="hidden" name="id_ingresos" value="{{ $relacion->id_ingresos }}">


                                    
                                </div>

                                <!-- Columna Derecha -->
                                <div class="col-md-6">
                                    

<!-- Aval 1 -->
                                    <x-adminlte-select name="id_aval1" label="Seleccionar Aval 1" fgroup-class="mb-3">
                                        <option value="">Seleccione un aval</option>
                                        @foreach ($avales as $aval)
                                            <option value="{{ $aval->id_persona }}" {{ $aval->id_persona == $relacion->id_aval1 ? 'selected' : '' }}>
                                                {{ $aval->nombres_apellidos }} - {{ $aval->n_identidad }}
                                            </option>
                                        @endforeach
                                    </x-adminlte-select>

                                    <!-- Aval 2 -->
                                    <x-adminlte-select name="id_aval2" label="Seleccionar Aval 2" fgroup-class="mb-3">
                                        <option value="">Seleccione un aval</option>
                                        @foreach ($avales as $aval)
                                            <option value="{{ $aval->id_persona }}" {{ $aval->id_persona == $relacion->id_aval2 ? 'selected' : '' }}>
                                                {{ $aval->nombres_apellidos }} - {{ $aval->n_identidad }}
                                            </option>
                                        @endforeach
                                    </x-adminlte-select>

                                    <!-- Aval 3 -->
                                    <x-adminlte-select name="id_aval3" label="Seleccionar Aval 3" fgroup-class="mb-3">
                                        <option value="">Seleccione un aval</option>
                                        @foreach ($avales as $aval)
                                            <option value="{{ $aval->id_persona }}" {{ $aval->id_persona == $relacion->id_aval3 ? 'selected' : '' }}>
                                                {{ $aval->nombres_apellidos }} - {{ $aval->n_identidad }}
                                            </option>
                                        @endforeach
                                    </x-adminlte-select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('relacion.index') }}" class="btn btn-secondary">Cancelar</a>
                            <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar" label="Actualizar Relación" theme="success" icon="fas fa-lg fa-save" />
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