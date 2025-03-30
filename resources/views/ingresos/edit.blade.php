@extends('adminlte::page')

@section('title', 'Editar Estado de Ingresos')

@section('content_header')
    <h1>Editar Estado de Ingreso</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Actualizar Estado de Ingreso</h3>
                    </div>
                    <form id="editForm" action="{{ route('ingresos.update', $ingresos['id_ingresos']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <!-- Columna Izquierda -->
                                <div class="col-md-6">
                                <!-- Nombre de la persona -->

                                <x-adminlte-input name="id_persona" label="Id persona" fgroup-class="mb-3" required
                                        value="{{ old('id_persona', $ingresos['id_persona'] ?? '') }}"  readonly/>

                                <x-adminlte-input name="nombres_persona" label="Nombre de la persona" fgroup-class="mb-3" required
                                        value="{{ old('nombres_persona', $ingresos['nombres_persona'] ?? '') }}"  readonly/>
                                
                                <!--Sueldo Base -->
                                <x-adminlte-input name="sueldo_base" label="Sueldo Base" fgroup-class="mb-3 income-field"
                                        value="{{ $ingresos['sueldo_base'] }}" type="number" min="0" step="0.01" required />
                                <!-- Remesas -->
                                <x-adminlte-input name="remesas" label="Remesas" fgroup-class="mb-3 income-field"
                                value="{{ $ingresos['remesas'] }}" type="number" min="0" step="0.01" required />

                                 <!-- Ingresos Sociedad -->
                                 <x-adminlte-input name="ingresos_sociedad" label="Ingresos Sociedad" fgroup-class="mb-3 income-field"
                                        value="{{ $ingresos['ingresos_sociedad'] }}" type="number" min="0" required />

                                        <!-- Renta de propiedad -->
                                <x-adminlte-input name="renta_propiedades" label="Renta de Propiedades" fgroup-class="mb-3 income-field"
                                        value="{{ $ingresos['renta_propiedades'] }}" type="number" min="0" required />
                                
                                        <!-- Aporte Cónyuge -->
                                 <x-adminlte-input name="aporte_conyuge" label="Aporte Cónyuge" fgroup-class="mb-3 income-field"
                                        value="{{ $ingresos['aporte_conyuge'] }}" type="number" min="0" step="0.01" required />
                                    
                                         <!-- Total Ingresos (Calculado automáticamente) -->
                                    <x-adminlte-input name="total_ingresos" label="Total Ingresos" fgroup-class="mb-3" 
                                        value="{{ $ingresos['total_ingresos'] }}" type="number" step="0.01" readonly />
                                </div>

                                <!-- Columna Derecha -->
                                <div class="col-md-6">
                                    <!-- Renta de Propiedades -->
                                    <x-adminlte-input name="cuota_de_prestamo" label="Cuota de prestamo" fgroup-class="mb-3 expense-field" 
                                    value="{{ $ingresos['cuota_de_prestamo'] }}" type="number" step="0.01" required />

                                    <x-adminlte-input name="cuota_vivienda" label="Cuota de vivienda" fgroup-class="mb-3 expense-field" 
                                    value="{{ $ingresos['cuota_vivienda'] }}" type="number" step="0" required />
                                   
                                    <x-adminlte-input name="alimentacion" label="Alimentacion" fgroup-class="mb-3 expense-field" 
                                    value="{{ $ingresos['alimentacion'] }}" type="number" step="0" required />

                                    <x-adminlte-input name="central_riesgo" label="Central de riesgo" fgroup-class="mb-3 expense-field" 
                                    value="{{ $ingresos['central_riesgo'] }}" type="number" step="0.01" required />
                                    
                                    <x-adminlte-input name="otro_egresos" label="Otros egresos" fgroup-class="mb-3 expense-field" 
                                    value="{{ $ingresos['otro_egresos'] }}" type="number" step="0.01" required />

                                    <x-adminlte-input name="total_egresos" label="Total egresos" fgroup-class="mb-3" 
                                    value="{{ $ingresos['total_egresos'] }}" type="number" step="0.01" readonly />

                                    <x-adminlte-input name="ingreso_neto" label="Ingreso Neto" fgroup-class="mb-3" 
                                    value="{{ $ingresos['ingreso_neto'] }}" type="number" step="0.01" readonly />

                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('ingresos.index') }}" class="btn btn-secondary">Cancelar</a>
                                <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar" label="Actualizar Estado de Ingreso" theme="success" icon="fas fa-lg fa-save" />
                            </div>
                        
</section>

@stop

@section('css')

@stop

@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Seleccionamos solo los inputs dentro de los componentes AdminLTE
        const incomeFields = document.querySelectorAll('.income-field input');
        const totalField = document.querySelector('input[name="total_ingresos"]');

        function calculateTotal() {
            let total = 0;
            incomeFields.forEach(field => {
                let value = parseFloat(field.value) || 0; // Evita NaN
                total += value;
            });
            totalField.value = total.toFixed(2);
        }

        // Escuchar eventos en los inputs reales dentro de AdminLTE
        incomeFields.forEach(field => {
            field.addEventListener('input', calculateTotal);
        });

        // Calcular el total inicial al cargar la página
        setTimeout(calculateTotal, 200);  // Da tiempo a que los valores se carguen bien
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Seleccionamos solo los inputs dentro de los componentes AdminLTE
        const incomeFields = document.querySelectorAll('.expense-field input');
        const totalField = document.querySelector('input[name="total_egresos"]');

        function calculateTotal() {
            let total = 0;
            incomeFields.forEach(field => {
                let value = parseFloat(field.value) || 0; // Evita NaN
                total += value;
            });
            totalField.value = total.toFixed(2);
        }

        // Escuchar eventos en los inputs reales dentro de AdminLTE
        incomeFields.forEach(field => {
            field.addEventListener('input', calculateTotal);
        });

        // Calcular el total inicial al cargar la página
        setTimeout(calculateTotal, 200);  // Da tiempo a que los valores se carguen bien
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Seleccionamos los inputs de ingresos, egresos e ingreso neto
        const incomeFields = document.querySelectorAll('.income-field input');
        const expenseFields = document.querySelectorAll('.expense-field input');
        const totalIngresosField = document.querySelector('input[name="total_ingresos"]');
        const totalEgresosField = document.querySelector('input[name="total_egresos"]');
        const ingresoNetoField = document.querySelector('input[name="ingreso_neto"]');

        function calculateTotalIngresos() {
            let totalIngresos = 0;
            incomeFields.forEach(field => {
                let value = parseFloat(field.value) || 0; // Evita NaN
                totalIngresos += value;
            });
            totalIngresosField.value = totalIngresos.toFixed(2);
            calculateIngresoNeto(); // Actualizar ingreso neto después de calcular ingresos
        }

        function calculateTotalEgresos() {
            let totalEgresos = 0;
            expenseFields.forEach(field => {
                let value = parseFloat(field.value) || 0; // Evita NaN
                totalEgresos += value;
            });
            totalEgresosField.value = totalEgresos.toFixed(2);
            calculateIngresoNeto(); // Actualizar ingreso neto después de calcular egresos
        }

        function calculateIngresoNeto() {
            const totalIngresos = parseFloat(totalIngresosField.value) || 0;
            const totalEgresos = parseFloat(totalEgresosField.value) || 0;
            const ingresoNeto = totalIngresos - totalEgresos;
            ingresoNetoField.value = ingresoNeto.toFixed(2);
        }

        // Escuchar eventos de entrada en los inputs de ingresos y egresos
        incomeFields.forEach(field => {
            field.addEventListener('input', calculateTotalIngresos);
        });

        expenseFields.forEach(field => {
            field.addEventListener('input', calculateTotalEgresos);
        });

        // Calcular los valores iniciales al cargar la página
        setTimeout(() => {
            calculateTotalIngresos();
            calculateTotalEgresos();
            calculateIngresoNeto();
        }, 200);
    });
</script>
@stop
