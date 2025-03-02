@extends('adminlte::page')

@section('title', 'Editar Solicitud')

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
                    <form id="editForm" action="{{ route('solicitudes.update', $solicitudes->id_solicitud) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <!-- Solicitud -->
                            <x-adminlte-select name="id_solicitud" label="Seleccionar Solicitud" fgroup-class="mb-3" required>
                                <option value="">Seleccione una solicitud</option>
                                @foreach ($solicitudes as $solicitud)
                                <option value="{{ $solicitudes->id_solicitud }}" {{ $solicitudes->id_solicitud == $solicitudes->id_solicitud ? 'selected' : '' }}>
                                    ID: {{ $solicitudes->id_solicitud }} - Monto: {{ number_format($solicitudes->monto, 2) }}
                                </option>
                                @endforeach
                            </x-adminlte-select>

                            <div class="row">
                                <!-- Columna Izquierda -->
                                <div class="col-md-6">
                                    <!-- Garantia -->
                                    <x-adminlte-select name="tipo_garantia" label="Seleccionar la Garantía" fgroup-class="mb-3" required>
                                        <option value="">Seleccione una Garantía</option>
                                        <option value="Fiduciaria" {{ old('tipo_garantia', $solicitudes->tipo_garantia) == 'Fiduciaria' ? 'selected' : '' }}>Fiduciaria</option>
                                        <option value="Prendaria" {{ old('tipo_garantia', $solicitudes->tipo_garantia) == 'Prendaria' ? 'selected' : '' }}>Prendaria</option>
                                        <option value="Hipotecaria" {{ old('tipo_garantia', $solicitudes->tipo_garantia) == 'Hipotecaria' ? 'selected' : '' }}>Hipotecaria</option>
                                        <option value="Solidaria" {{ old('tipo_garantia', $solicitudes->tipo_garantia) == 'Solidaria' ? 'selected' : '' }}>Solidaria</option>
                                    </x-adminlte-select>


                                    <!-- Cuota -->
                                    <x-adminlte-select name="tipo_cuota" label="Seleccionar Tipo de Cuota" fgroup-class="mb-3" required>
                                        <option value="">Seleccione una Cuota</option>
                                        <option value="Nivelada" {{ old('tipo_cuota', $solicitudes->tipo_cuota) == 'Nivelada' ? 'selected' : '' }}>Nivelada</option>
                                        <option value="Variable" {{ old('tipo_cuota', $solicitudes->tipo_cuota) == 'Variable' ? 'selected' : '' }}>Variable</option>
                                    </x-adminlte-select>


                                    <!-- Tasa -->
                                    <x-adminlte-select name="tasa" label="Seleccionar Tasa de Interés" fgroup-class="mb-3" required>
                                        <option value="">Seleccione una tasa</option>
                                        @for ($tasa = 1.00; $tasa <= 10.00; $tasa +=0.5)
                                            <option value="{{ number_format($tasa, 2) }}"
                                            {{ old('tasa', $solicitudes->tasa) == number_format($tasa, 2) ? 'selected' : '' }}>
                                            {{ number_format($tasa, 2) }}%
                                            </option>
                                            @endfor
                                    </x-adminlte-select>

                                    <x-adminlte-select name="plazo" label="Seleccionar Plazo (Meses)" fgroup-class="mb-3" required>
                                        <option value="">Seleccione un plazo</option>
                                        @for ($plazo = 6; $plazo <= 60; $plazo +=6)
                                            <option value="{{ $plazo }}" {{ old('plazo', $solicitudes->plazo) == $plazo ? 'selected' : '' }}>
                                            {{ $plazo }} meses
                                            </option>
                                            @endfor
                                    </x-adminlte-select>

                                    <x-adminlte-input name="monto" type="number" label="Monto del Préstamo"
                                        placeholder="Ingrese el monto" fgroup-class="mb-3"
                                        step="0.01" min="1000" max="100000" required
                                        value="{{ old('monto', $solicitudes->monto) }}" />



                                </div>

                                <!-- Columna Derecha -->
                                <div class="col-md-6">
                                <!-- invierte en -->
                                <x-adminlte-select name="invierte_en" label="Sector de Inversión" fgroup-class="mb-3" required>
                                    <option value="">Seleccione un sector</option>
                                    <option value="Comercio" {{ old('invierte_en', $solicitudes->invierte_en) == 'Comercio' ? 'selected' : '' }}>Comercio</option>
                                    <option value="Industria" {{ old('invierte_en', $solicitudes->invierte_en) == 'Industria' ? 'selected' : '' }}>Industria</option>
                                    <option value="Servicios" {{ old('invierte_en', $solicitudes->invierte_en) == 'Servicios' ? 'selected' : '' }}>Servicios</option>
                                    <option value="Agropecuario" {{ old('invierte_en', $solicitudes->invierte_en) == 'Agropecuario' ? 'selected' : '' }}>Agropecuario</option>
                                </x-adminlte-select>


                                <!-- Credito -->
                                <x-adminlte-select name="tipo_credito" label="Tipo de Crédito" fgroup-class="mb-3" required>
                                    <option value="">Seleccione un tipo de crédito</option>
                                    <option value="Reingreso" {{ old('tipo_credito', $solicitudes->tipo_credito) == 'Reingreso' ? 'selected' : '' }}>Reingreso</option>
                                    <option value="Refinanciamiento" {{ old('tipo_credito', $solicitudes->tipo_credito) == 'Refinanciamiento' ? 'selected' : '' }}>Refinanciamiento</option>
                                    <option value="Novacion" {{ old('tipo_credito', $solicitudes->tipo_credito) == 'Novacion' ? 'selected' : '' }}>Novación</option>
                                    <option value="Primera Vez" {{ old('tipo_credito', $solicitudes->tipo_credito) == 'Primera Vez' ? 'selected' : '' }}>Primera Vez</option>
                                </x-adminlte-select>


                                <!-- Estado Solicitud -->
                                <x-adminlte-select name="estado_solicitud" label="Estado de la Solicitud" fgroup-class="mb-3">
                                    <option value="">Seleccione el estado</option>
                                    <option value="Pendiente" {{ old('estado_solicitud', $solicitudes->estado_solicitud) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="Aprobado" {{ old('estado_solicitud', $solicitudes->estado_solicitud) == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
                                    <option value="Rechazado" {{ old('estado_solicitud', $solicitudes->estado_solicitud) == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                                </x-adminlte-select>


                                <!-- Valor Cuota-->
                                <x-adminlte-input name="valor_cuota" type="number" label="Valor de la Cuota"
                                    placeholder="Ingresa el valor de la cuota" fgroup-class="mb-3" step="0.01" min="0"
                                    value="{{ old('valor_cuota', $solicitudes->valor_cuota) }}" required />

                                <!-- Es Aval-->
                                <x-adminlte-select name="es_aval" label="Tipo de Aval" fgroup-class="mb-3" required>
                                    <option value="">Seleccione el tipo de aval</option>
                                    <option value="No es aval" {{ old('es_aval', $solicitudes->es_aval) == 'No es aval' ? 'selected' : '' }}>No es aval</option>
                                    <option value="Avala 1 persona" {{ old('es_aval', $solicitudes->es_aval) == 'Avala 1 persona' ? 'selected' : '' }}>Avala 1 persona</option>
                                    <option value="Avala 2 personas" {{ old('es_aval', $solicitudes->es_aval) == 'Avala 2 personas' ? 'selected' : '' }}>Avala 2 personas</option>
                                    <option value="Avala mas de 2 personas" {{ old('es_aval', $solicitudes->es_aval) == 'Avala mas de 2 personas' ? 'selected' : '' }}>Avala más de 2 personas</option>
                                </x-adminlte-select>


                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('solicitudes.index') }}" class="btn btn-secondary">Cancelar</a>
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

@stop