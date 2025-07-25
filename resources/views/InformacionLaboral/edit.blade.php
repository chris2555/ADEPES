@extends('adminlte::page')

@section('title', 'Editar Información Laboral')

@section('content_header')
    <h1>Editar Información Laboral</h1>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Actualizar Información Laboral</h3>
                        </div>
                        <form id="editForm" action="{{ route('informacionlaboral.update', $informacionlaboral['id_informacion_laboral']) }}" method="POST">
                        @csrf
                         @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <!-- Columna Izquierda -->
                                    <div class="col-md-6">
                                        <x-adminlte-input name="nombre_persona" label="Nombre de la Persona" fgroup-class="mb-3"
    value="{{ $nombre_persona ?? '' }}" disabled />

                                        <x-adminlte-input name="profesion_oficio" label="Profesión u Oficio" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['profesion_oficio'] ?? '' }}" required />
{{-- Profesión u Oficio --}}
<div class="text-danger d-none" id="err-profesion_oficio">Este campo solo permite letras.</div>

                                        <x-adminlte-input name="actividad" label="Actividad" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['actividad'] ?? '' }}" required />
{{-- Actividad --}}
<div class="text-danger d-none" id="err-actividad">Este campo solo permite letras.</div>

                                        <x-adminlte-input name="ingresos_negocio" label="Ingresos Negocio" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['ingresos_negocio'] ?? '' }}" required />
{{-- Ingresos del Negocio --}}
<div class="text-danger d-none" id="err-ingresos_negocio">Este campo solo permite números válidos.</div>

                                        <x-adminlte-input name="direccion_trabajo" label="Dirección Trabajo" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['direccion_trabajo'] ?? '' }}" required />

                                       
                                    </div>
                                    <!-- Columna Derecha -->
                                    <div class="col-md-6">
 <x-adminlte-input name="patrono_negocio" label="Patrono Negocio" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['patrono_negocio'] ?? '' }}" required />
{{-- Patrono o Negocio --}}
<div class="text-danger d-none" id="err-patrono_negocio">Este campo solo permite letras.</div>

                                        <x-adminlte-input name="tiempo_laborar" label="Tiempo de Laborar" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['tiempo_laborar'] ?? '' }}" required />

                                        <x-adminlte-input name="gastos_alimentacion" label="Gastos de Alimentación" fgroup-class="mb-3"
                                            value="{{ $informacionlaboral['gastos_alimentacion'] ?? '' }}" required />

{{-- Gastos de Alimentación --}}
<div class="text-danger d-none" id="err-gastos_alimentacion">Este campo solo permite números válidos.</div>
                                    </div>
                                </div>
                            </div> <!-- Fin de card-body -->

                            <div class="card-footer">
                                <a href="{{ route('informacionlaboral.index') }}" class="btn btn-secondary">Cancelar</a>
                                <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar"
                                    label="Actualizar Información Laboral" theme="success" icon="fas fa-lg fa-save" />
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
document.addEventListener('DOMContentLoaded', () => {
    const soloLetras = v => /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(v);
    const soloNumeros = v => /^\d+(\.\d{1,2})?$/.test(v); // admite decimales

    const f = document.getElementById('editForm');

    const campos = {
        profesion_oficio      : {in: f.profesion_oficio,      err: 'err-profesion_oficio',      val: v => soloLetras(v)},
        actividad             : {in: f.actividad,             err: 'err-actividad',             val: v => soloLetras(v)},
        patrono_negocio       : {in: f.patrono_negocio,       err: 'err-patrono_negocio',       val: v => soloLetras(v)},
        ingresos_negocio      : {in: f.ingresos_negocio,      err: 'err-ingresos_negocio',      val: v => soloNumeros(v)},
        gastos_alimentacion   : {in: f.gastos_alimentacion,   err: 'err-gastos_alimentacion',   val: v => soloNumeros(v)},
    };

    // Validaciones en tiempo real
    for(const key in campos){
        campos[key].in.addEventListener('input', () => toggleError(key));
    }

    // Validación final al enviar
    f.addEventListener('submit', e => {
        let ok = true;
        for(const key in campos){
            if(!toggleError(key)) ok = false;
        }
        if(!ok){
            e.preventDefault();
            Swal.fire({icon:'error',title:'Corrija los campos marcados',confirmButtonColor:'#d33'});
        }
    });

    function toggleError(key){
        const {in:input, err, val} = campos[key];
        const show = !val(input.value.trim());
        document.getElementById(err).classList.toggle('d-none', !show);
        input.classList.toggle('is-invalid', show);
        return !show;
    }
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