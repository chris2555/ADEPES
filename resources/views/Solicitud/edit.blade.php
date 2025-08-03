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
                           <x-adminlte-select name="id_solicitud_mostrado" label="Solicitud" fgroup-class="mb-3" disabled>
    <option selected>
        ID: {{ $solicitudes->id_solicitud }} - Monto: L {{ number_format($solicitudes->monto, 2) }}
    </option>
</x-adminlte-select>

<!-- Input oculto para enviar el ID real al backend -->
<input type="hidden" name="id_solicitud" value="{{ $solicitudes->id_solicitud }}">


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
                                        @for ($tasa = 1.00; $tasa <= 12.00; $tasa +=0.5)
                                            <option value="{{ number_format($tasa, 2) }}"
                                            {{ old('tasa', $solicitudes->tasa) == number_format($tasa, 2) ? 'selected' : '' }}>
                                            {{ number_format($tasa, 2) }}%
                                            </option>
                                            @endfor
                                    </x-adminlte-select>

                                    <x-adminlte-select name="plazo" label="Seleccionar Plazo (Meses)" fgroup-class="mb-3" required>
                                        <option value="">Seleccione un plazo</option>
                                        @foreach ([12, 24, 36, 48] as $plazo)
                                            <option value="{{ $plazo }}" {{ old('plazo', $solicitudes->plazo) == $plazo ? 'selected' : '' }}>
                                                {{ $plazo }} meses
                                            </option>
                                        @endforeach
                                    </x-adminlte-select>

                                    <x-adminlte-input name="monto" type="number" label="Monto del Préstamo"
                                        placeholder="Ingrese el monto" fgroup-class="mb-3"
                                        step="0.01" min="1000" max="100000" required
                                        value="{{ old('monto', $solicitudes->monto) }}" />
                                        <x-adminlte-input name="finalidad_cre" type="text" label="Finalidad del Crédito"
                                         placeholder="Ej. Compra de insumos, expansión de negocio..." fgroup-class="mb-3"
                                         maxlength="50" required value="{{ $solicitudes->finalidad_cre }}"
                                         pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+\.?$"
                                         title="Solo letras, espacios y un punto final opcional. No se permiten números ni signos especiales." />

                                        <x-adminlte-input name="capital" type="number" label="Capital"
                                            placeholder="Ingrese el capital" fgroup-class="mb-3" step="0.01" min="0"
                                            value="{{ $solicitudes->capital }}" readonly />

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

                                <x-adminlte-input name="interes" type="number" label="Interés"
                                    placeholder="Ingrese el interés" fgroup-class="mb-3" step="0.01" min="0"
                                    value="{{ $solicitudes->interes }}" readonly />


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

<script>
    function viewModal(solicitud) {
        document.getElementById('capital').innerText = 'L ' + solicitud.monto.toLocaleString('es-HN', { minimumFractionDigits: 2 });
        let interesCalculado = (solicitud.monto * solicitud.tasa / 100) * solicitud.plazo;
        document.getElementById('interes').innerText = 'L ' + interesCalculado.toFixed(2).toLocaleString('es-HN');
        new bootstrap.Modal(document.getElementById('view')).show();
    }
</script>

    


    <script>
    document.addEventListener("DOMContentLoaded", function () {
    const tipoCuota = document.querySelector("select[name='tipo_cuota']");
    const tasa = document.querySelector("select[name='tasa']");
    const plazo = document.querySelector("select[name='plazo']");
    const monto = document.querySelector("input[name='monto']");
    const valorCuota = document.querySelector("input[name='valor_cuota']");
    const capital = document.querySelector("input[name='capital']");
    const interes = document.querySelector("input[name='interes']");

    function calcularCuota() {
        const tipo = tipoCuota.value;
        const tasaInteres = parseFloat(tasa.value) / 100;
        const plazoMeses = parseInt(plazo.value);
        let montoPrestamo = parseFloat(monto.value);

        if (!tipo || isNaN(tasaInteres) || isNaN(plazoMeses) || isNaN(montoPrestamo)) {
            valorCuota.value = "";
            capital.value = "";
            interes.value = "";
            return;
        }

        let cuotaFija, interesMensual, capitalMensual;
        
        if (tipo === "Nivelada") {
            const r = tasaInteres / 12;
            cuotaFija = (montoPrestamo * r * Math.pow(1 + r, plazoMeses)) / (Math.pow(1 + r, plazoMeses) - 1);
            
            interesMensual = montoPrestamo * r;
            capitalMensual = cuotaFija - interesMensual;
        } else {
            interesMensual = (montoPrestamo * tasaInteres / 12);
            capitalMensual = montoPrestamo / plazoMeses;
            cuotaFija = interesMensual + capitalMensual;
        }

        valorCuota.value = cuotaFija.toFixed(2);
        capital.value = capitalMensual.toFixed(2);
        interes.value = interesMensual.toFixed(2);
    }

    tipoCuota.addEventListener("change", calcularCuota);
    tasa.addEventListener("change", calcularCuota);
    plazo.addEventListener("change", calcularCuota);
    monto.addEventListener("input", calcularCuota);
});
    </script>


@stop


