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
                                    <!-- ID Solicitud -->
                                    <x-adminlte-select name="id_solicitud" label="Seleccionar Solicitud" fgroup-class="mb-3" required>
                                        <option value="">Seleccione una solicitud</option>
                                        @foreach ($solicitudes as $solicitud)
                                            <option value="{{ $solicitud->id_solicitud }}" 
                                                {{ $solicitud->id_solicitud == $ingresos['id_solicitud'] ? 'selected' : '' }}>
                                                {{ $solicitud->id_solicitud }} 
                                            </option>
                                        @endforeach
                                    </x-adminlte-select>

                                    <!-- Remesas -->
                                    <x-adminlte-input name="remesas" label="Remesas" fgroup-class="mb-3 income-field"
                                        value="{{ $ingresos['remesas'] }}" type="number" min="0" step="0.01" required />

                                    <!-- Ingresos Sociedad -->
                                    <x-adminlte-input name="ingresos_sociedad" label="Ingresos Sociedad" fgroup-class="mb-3 income-field"
                                        value="{{ $ingresos['ingresos_sociedad'] }}" type="number" min="0" required />
                                </div>

                                <!-- Columna Derecha -->
                                <div class="col-md-6">
                                    <!-- Renta de Propiedades -->
                                    <x-adminlte-input name="renta_propiedades" label="Renta de Propiedades" fgroup-class="mb-3 income-field"
                                        value="{{ $ingresos['renta_propiedades'] }}" type="number" min="0" required />

                                    <!-- Aporte Cónyuge -->
                                    <x-adminlte-input name="aporte_conyuge" label="Aporte Cónyuge" fgroup-class="mb-3 income-field"
                                        value="{{ $ingresos['aporte_conyuge'] }}" type="number" min="0" step="0.01" required />

                                    <!-- Total Ingresos (Calculado automáticamente) -->
                                    <x-adminlte-input name="total_ingresos" label="Total Ingresos" fgroup-class="mb-3" 
                                        value="{{ $ingresos['total_ingresos'] }}" type="number" step="0.01" readonly />
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('ingresos.index') }}" class="btn btn-secondary">Cancelar</a>
                                <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar"
                                    label="Actualizar Estado de Ingreso" theme="success" icon="fas fa-lg fa-save" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

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
