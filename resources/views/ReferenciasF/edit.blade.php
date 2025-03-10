@extends('adminlte::page')

@section('title', 'Editar Referencia Familiar')

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
                    
                    <form id="editForm" action="{{ route('referencias.update', $referencia['id_referencia']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            
                            <div class="row">
                                <!-- ID de Solicitud -->
                                <div class="col-md-6">
                                    <x-adminlte-select name="id_solicitud" label="Solicitud Asociada" fgroup-class="mb-3" required>
                                        <option value="">Seleccione una solicitud</option>
                                        @foreach ($solicitudes as $solicitud)
                                            <option value="{{ $solicitud->id_solicitud }}" 
                                                {{ $solicitud->id_solicitud == $referencia->id_solicitud ? 'selected' : '' }}>
                                                ID: {{ $referencia['id_referencia'] }}
                                            </option>
                                        @endforeach
                                    </x-adminlte-select>
                                </div>

                                <!-- Nombre del Familiar -->
                                <div class="col-md-6">
                                    <x-adminlte-input name="nombre_familiar" label="Nombre del Familiar" value="{{ $referencia->nombre_familiar }}" required fgroup-class="mb-3" />
                                </div>
                            </div>

                            <div class="row">
                                <!-- Parentesco -->
                                <div class="col-md-6">
                                    <x-adminlte-input name="parentesco" label="Parentesco" value="{{ $referencia->parentesco }}" fgroup-class="mb-3" />
                                </div>

                                <!-- Dirección -->
                                <div class="col-md-6">
                                    <x-adminlte-textarea name="direccion_familiar" label="Dirección" fgroup-class="mb-3" rows="3">{{ $referencia->direccion_familiar }}</x-adminlte-textarea>
                                </div>
                            </div>

                            <!-- Usuario Modificador -->
                            <input type="hidden" name="modificado_por" value="{{ auth()->user()->id }}">
                        
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('referencias.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Actualizar Referencia</button>
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
