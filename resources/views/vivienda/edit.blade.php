@extends('adminlte::page')

@section('title', 'Editar Vivienda')

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
                            <h3 class="card-title">Actualizar Vivienda</h3>
                        </div>
                        <form id="editForm" action="{{ route('viviendas.update', $vivienda['id_vivienda']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-adminlte-select name="tipo_casa" label="Tipo de Casa" fgroup-class="mb-3" required>
                                            <option value="Alquila" {{ $vivienda['tipo_casa'] == 'Alquila' ? 'selected' : '' }}>Alquila</option>
                                            <option value="Propia" {{ $vivienda['tipo_casa'] == 'Propia' ? 'selected' : '' }}>Propia</option>
                                            <option value="Familiar" {{ $vivienda['tipo_casa'] == 'Familiar' ? 'selected' : '' }}>Familiar</option>
                                        </x-adminlte-select>

                                        <x-adminlte-select name="tiempo_vivir" label="Tiempo de Vivir" fgroup-class="mb-3" required>
                                            <option value="1 año" {{ $vivienda['tiempo_vivir'] == '1 año' ? 'selected' : '' }}>1 año</option>
                                            <option value="2 años" {{ $vivienda['tiempo_vivir'] == '2 años' ? 'selected' : '' }}>2 años</option>
                                            <option value="3 años" {{ $vivienda['tiempo_vivir'] == '3 años' ? 'selected' : '' }}>3 años</option>
                                            <option value="4 años" {{ $vivienda['tiempo_vivir'] == '4 años' ? 'selected' : '' }}>4 años</option>
                                            <option value="Más de 5 años" {{ $vivienda['tiempo_vivir'] == 'Más de 5 años' ? 'selected' : '' }}>Más de 5 años</option>
                                        </x-adminlte-select>

                                        <x-adminlte-select name="pago_vivienda" label="Pago de Vivienda" fgroup-class="mb-3">
                                            <option value="SI" {{ $vivienda['pago_vivienda'] == 'SI' ? 'selected' : '' }}>SI</option>
                                            <option value="NO" {{ $vivienda['pago_vivienda'] == 'NO' ? 'selected' : '' }}>NO</option>
                                        </x-adminlte-select>

                                        <x-adminlte-select name="tipo_pago_vivienda" label="Tipo de Pago" fgroup-class="mb-3">
                                            <option value="Semanal" {{ $vivienda['tipo_pago_vivienda'] == 'Semanal' ? 'selected' : '' }}>Semanal</option>
                                            <option value="Quincenal" {{ $vivienda['tipo_pago_vivienda'] == 'Quincenal' ? 'selected' : '' }}>Quincenal</option>
                                            <option value="Mensual" {{ $vivienda['tipo_pago_vivienda'] == 'Mensual' ? 'selected' : '' }}>Mensual</option>
                                        </x-adminlte-select>

                                        <x-adminlte-input name="valor_pago" label="Valor de Pago" type="number" fgroup-class="mb-3" value="{{ $vivienda['valor_pago'] }}" />
                                    </div>

                                    <div class="col-md-6">
                                        <x-adminlte-select name="material_construccion" label="Material de Construcción" fgroup-class="mb-3" required>
                                            <option value="Concreto" {{ $vivienda['material_construccion'] == 'Concreto' ? 'selected' : '' }}>Concreto</option>
                                            <option value="Madera" {{ $vivienda['material_construccion'] == 'Madera' ? 'selected' : '' }}>Madera</option>
                                            <option value="Mixto" {{ $vivienda['material_construccion'] == 'Mixto' ? 'selected' : '' }}>Mixto</option>
                                        </x-adminlte-select>

                                        <x-adminlte-input name="dependiente" label="Número de Dependientes" type="number" fgroup-class="mb-3" value="{{ $vivienda['dependiente'] }}" />

                                        <x-adminlte-textarea name="direccion_completa" label="Dirección" fgroup-class="mb-3">{{ $vivienda['direccion_completa'] }}</x-adminlte-textarea>

                                        <x-adminlte-select name="id_persona" label="Seleccionar Persona" fgroup-class="mb-3" required>
                                            <option value="">Seleccione una persona</option>
                                            @foreach ($personas as $persona)
                                                <option value="{{ $persona->id_persona }}" {{ $persona->id_persona == $vivienda['id_persona'] ? 'selected' : '' }}>
                                                    {{ $persona->nombres_apellidos }} - {{ $persona->n_identidad }}
                                                </option>
                                            @endforeach
                                        </x-adminlte-select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('viviendas.index') }}" class="btn btn-secondary">Cancelar</a>
                                    <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar" label="Actualizar Vivienda" theme="success" icon="fas fa-lg fa-save" />
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
