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
                            <!-- Solicitud -->
                            <x-adminlte-select name="id_solicitud" label="Seleccionar Solicitud" fgroup-class="mb-3" required>
                                <option value="">Seleccione una solicitud</option>
                                @foreach ($solicitudes as $solicitud)
                                    <option value="{{ $solicitud->id_solicitud }}" {{ $solicitud->id_solicitud == $relacion->id_solicitud ? 'selected' : '' }}>
                                        ID: {{ $solicitud->id_solicitud }} - Monto: {{ number_format($solicitud->monto, 2) }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>

                            <div class="row">
                                <!-- Columna Izquierda -->
                                <div class="col-md-6">
                                    <!-- Persona -->
                                    <x-adminlte-select name="id_persona" label="Seleccionar Persona" fgroup-class="mb-3" required>
                                        <option value="">Seleccione una persona</option>
                                        @foreach ($personas as $persona)
                                            <option value="{{ $persona->id_persona }}" {{ $persona->id_persona == $relacion->id_persona ? 'selected' : '' }}>
                                                {{ $persona->nombres_apellidos }} - {{ $persona->n_identidad }}
                                            </option>
                                        @endforeach
                                    </x-adminlte-select>

                                    <!-- Ingresos -->
                                    <x-adminlte-select name="id_ingresos" label="Seleccione un ingreso" fgroup-class="mb-3" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($ingresos as $ingreso)
                                            <option value="{{ $ingreso->id_ingresos }}" {{ $ingreso->id_ingresos == $relacion->id_ingresos ? 'selected' : '' }}>
                                                {{ $ingreso->id_ingresos }} - {{ $ingreso->total_ingresos }}
                                            </option>
                                        @endforeach
                                    </x-adminlte-select>

                                    <!-- Aval 1 -->
                                    <x-adminlte-select name="id_aval1" label="Seleccionar Aval 1" fgroup-class="mb-3">
                                        <option value="">Seleccione un aval</option>
                                        @foreach ($avales as $aval)
                                            <option value="{{ $aval->id_persona }}" {{ $aval->id_persona == $relacion->id_aval1 ? 'selected' : '' }}>
                                                {{ $aval->nombres_apellidos }} - {{ $aval->n_identidad }}
                                            </option>
                                        @endforeach
                                    </x-adminlte-select>
                                </div>

                                <!-- Columna Derecha -->
                                <div class="col-md-6">
                                    <!-- Cónyuge -->
                                    <x-adminlte-select name="id_conyuge" label="ID Cónyuge" fgroup-class="mb-3" required>
                                        <option value="">Seleccione un cónyuge</option>
                                        @foreach ($conyuges as $conyuge)
                                            <option value="{{ $conyuge->id_conyuge }}" {{ $conyuge->id_conyuge == $relacion->id_conyuge ? 'selected' : '' }}>
                                                {{ $conyuge->nombres_conyuge }} - {{ $conyuge->identidad_conyuge }}
                                            </option>
                                        @endforeach
                                    </x-adminlte-select>

                                    <!-- Egresos -->
                                    <x-adminlte-select name="id_egresos" label="Seleccione un egreso" fgroup-class="mb-3" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($egresos as $egreso)
                                            <option value="{{ $egreso->id_egresos }}" {{ $egreso->id_egresos == $relacion->id_egresos ? 'selected' : '' }}>
                                                {{ $egreso->id_egresos }} - {{ $egreso->total_egresos }}
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