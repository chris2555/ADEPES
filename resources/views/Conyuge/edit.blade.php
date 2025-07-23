@extends('adminlte::page')

@section('title', 'Editar información Conyuge')

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
                        <h3 class="card-title">Actualizar Conyuge</h3>
                    </div>
                    <form id="editForm" action="{{ route('conyuge.update', $solicitudes['id_conyuge']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <!-- Columna Izquierda -->
                                <div class="col-md-6">
                                    {{-- NOMBRE sin números --}}
<x-adminlte-input name="nombres_conyuge" id="nombres_conyuge" label="Nombre del Cónyuge"
                  fgroup-class="mb-3" required
                  value="{{ old('nombres_conyuge', $solicitudes['nombres_conyuge'] ?? '') }}"/>
<small id="err-nombre" class="text-danger d-none">Solo letras y espacios.</small>

                                    <x-adminlte-input name="fecha_nacimiento_conyuge" label="Fecha de Nacimiento del Cónyuge"
                                        type="date" fgroup-class="mb-3" id="fecha_nacimiento_conyuge" required
                                        value="{{ \Carbon\Carbon::parse($solicitudes['fecha_nacimiento_conyuge'])->format('Y-m-d') }}" />
                                    <div class="text-danger" id="error_fecha"></div>

                                    {{-- IDENTIDAD – exactamente 13 dígitos --}}
<x-adminlte-input name="identidad_conyuge" id="identidad_conyuge" label="Identidad del Cónyuge"
                  fgroup-class="mb-3" required
                  value="{{ old('identidad_conyuge', $solicitudes['identidad_conyuge'] ?? '') }}"/>
<small id="err-identidad" class="text-danger d-none">Debe contener 13 números.</small>

                                    <x-adminlte-textarea name="direccion_conyuge" label="Dirección del Cónyuge"
                                        fgroup-class="mb-3" required>{{ old('direccion_conyuge', $solicitudes['direccion_conyuge'] ?? '') }}</x-adminlte-textarea>

                                    {{-- PROFESIÓN – sin números --}}
<x-adminlte-input name="profesion_oficio_conyuge" id="profesion_oficio_conyuge"
                  label="Profesión u Oficio del Cónyuge" fgroup-class="mb-3" required
                  value="{{ old('profesion_oficio_conyuge', $solicitudes['profesion_oficio_conyuge'] ?? '') }}"/>
<small id="err-profesion" class="text-danger d-none">Solo letras y espacios.</small>

                                    {{-- CARGO – sin números --}}
<x-adminlte-input name="cargo_conyuge" id="cargo_conyuge" label="Cargo del Cónyuge"
                  fgroup-class="mb-3" required
                  value="{{ old('cargo_conyuge', $solicitudes['cargo_conyuge'] ?? '') }}"/>
<small id="err-cargo" class="text-danger d-none">Solo letras y espacios.</small>
                                </div>

                                <!-- Columna Derecha -->
                                <div class="col-md-6">
                                    <x-adminlte-input name="ingresos_negocio_conyuge" label="Ingresos del Negocio del Cónyuge"
                                        type="number" step="0.01" fgroup-class="mb-3" required
                                        value="{{ old('ingresos_negocio_conyuge', $solicitudes['ingresos_negocio_conyuge'] ?? '') }}" />

                                    <x-adminlte-textarea name="direccion_trabajo_conyuge" label="Dirección de Trabajo del Cónyuge"
                                        fgroup-class="mb-3" required>{{ old('direccion_trabajo_conyuge', $solicitudes['direccion_trabajo_conyuge'] ?? '') }}</x-adminlte-textarea>

                                    <x-adminlte-select name="tipo_cliente" label="Tipo de Cliente" fgroup-class="mb-3" required>
                                        <option value="">Seleccione un Tipo</option>
                                        <option value="Activo" {{ old('tipo_cliente', $solicitudes['tipo_cliente'] ?? '') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="Inactivo" {{ old('tipo_cliente', $solicitudes['tipo_cliente'] ?? '') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                        <option value="Primera vez" {{ old('tipo_cliente', $solicitudes['tipo_cliente'] ?? '') == 'Primera vez' ? 'selected' : '' }}>Primera vez</option>
                                    </x-adminlte-select>

                                    <x-adminlte-select name="tiempo_laborar_conyuge" label="Tiempo de Laborar del Cónyuge" fgroup-class="mb-3" required>
                                        <option value="">Seleccione un Tiempo</option>
                                        <option value="1 año" {{ old('tiempo_laborar_conyuge', $solicitudes['tiempo_laborar_conyuge'] ?? '') == '1 año' ? 'selected' : '' }}>1 año</option>
                                        <option value="2 años" {{ old('tiempo_laborar_conyuge', $solicitudes['tiempo_laborar_conyuge'] ?? '') == '2 años' ? 'selected' : '' }}>2 años</option>
                                        <option value="3 años" {{ old('tiempo_laborar_conyuge', $solicitudes['tiempo_laborar_conyuge'] ?? '') == '3 años' ? 'selected' : '' }}>3 años</option>
                                        <option value="4 años" {{ old('tiempo_laborar_conyuge', $solicitudes['tiempo_laborar_conyuge'] ?? '') == '4 años' ? 'selected' : '' }}>4 años</option>
                                        <option value="Más de 5 años" {{ old('tiempo_laborar_conyuge', $solicitudes['tiempo_laborar_conyuge'] ?? '') == 'Más de 5 años' ? 'selected' : '' }}>Más de 5 años</option>
                                    </x-adminlte-select>

                                    <x-adminlte-input name="gastos_alimentacion_conyuge" label="Gastos de Alimentación del Cónyuge"
                                        type="number" step="0.01" fgroup-class="mb-3" required
                                        value="{{ old('gastos_alimentacion_conyuge', $solicitudes['gastos_alimentacion_conyuge'] ?? '') }}" />

                                    {{-- ESTADO CRÉDITO – sin números --}}
<x-adminlte-input name="estado_credito_conyuge" id="estado_credito_conyuge"
                  label="Estado de Crédito del Cónyuge" fgroup-class="mb-3" required
                  value="{{ old('estado_credito_conyuge', $solicitudes['estado_credito_conyuge'] ?? '') }}"/>
<small id="err-credito" class="text-danger d-none">Solo letras y espacios.</small>

                                    {{-- TELÉFONO – 8 dígitos + guion automático --}}
<x-adminlte-input name="telefono_conyuge" id="telefono_conyuge"
                  label="Teléfono del Cónyuge" fgroup-class="mb-3" required
                  value="{{ old('telefono_conyuge', $solicitudes['telefono_conyuge'] ?? '') }}"/>
<small id="err-telefono" class="text-danger d-none">Formato válido: ####-####.</small>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('conyuge.index') }}" class="btn btn-secondary">Cancelar</a>
                            <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar" label="Actualizar Información" theme="success" icon="fas fa-lg fa-save" />
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

    /*–––– helpers ––––*/
    const soloLetras = v => /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(v);
    const soloNumeros = v => /^\d+$/.test(v);

    /*–––– referencias ––––*/
    const f = document.getElementById('editForm');

    const campos = {
        nombre   : {in: f.nombres_conyuge,          err: 'err-nombre',     val: v => soloLetras(v)},
        profesion: {in: f.profesion_oficio_conyuge, err: 'err-profesion',  val: v => soloLetras(v)},
        cargo    : {in: f.cargo_conyuge,            err: 'err-cargo',      val: v => soloLetras(v)},
        credito  : {in: f.estado_credito_conyuge,   err: 'err-credito',    val: v => soloLetras(v)},
        identidad: {in: f.identidad_conyuge,        err: 'err-identidad',  val: v => soloNumeros(v) && v.length===13},
        telefono : {in: f.telefono_conyuge,         err: 'err-telefono',   val: v => /^[23789]\d{3}-\d{4}$/.test(v)}
    };

    /*–––– formateo & validación en tiempo real ––––*/
    // identidad (solo números, máx 13)
    campos.identidad.in.addEventListener('input', e=>{
        e.target.value = e.target.value.replace(/\D/g,'').slice(0,13);
        toggleError('identidad');
    });

    // teléfono ####-####
    campos.telefono.in.addEventListener('input', e=>{
        let v = e.target.value.replace(/\D/g,'').slice(0,8);
        if(v.length>4) v = v.slice(0,4)+'-'+v.slice(4);
        e.target.value = v;
        toggleError('telefono');
    });

    // los que solo admiten letras
    ['nombre','profesion','cargo','credito'].forEach(k=>{
        campos[k].in.addEventListener('input', ()=> toggleError(k));
    });

    /*–––– envío ––––*/
    f.addEventListener('submit', e=>{
        let ok = true;
        for(const k in campos){
            if(!toggleError(k)) ok=false;
        }
        if(!ok){
            e.preventDefault();
            Swal.fire({icon:'error',title:'Corrija los campos marcados',confirmButtonColor:'#d33'});
        }
    });

    /*–––– función helper ––––*/
    function toggleError(key){
        const {in:input, err, val} = campos[key];
        const show = !val(input.value.trim());
        document.getElementById(err).classList.toggle('d-none', !show);
        input.classList.toggle('is-invalid', show);
        return !show;
    }
});

 const fechaInput = document.getElementById('fecha_nacimiento_conyuge');
    const errorFecha = document.getElementById('error_fecha');

    fechaInput.addEventListener('change', () => {
        validarFecha();
    });

    function calcularEdad(fecha) {
        const hoy = new Date();
        const nacimiento = new Date(fecha);
        let edad = hoy.getFullYear() - nacimiento.getFullYear();
        const mes = hoy.getMonth() - nacimiento.getMonth();
        if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) {
            edad--;
        }
        return edad;
    }

    function validarFecha() {
        const fecha = fechaInput.value;
        const edad = calcularEdad(fecha);

        if (!fecha || isNaN(edad) || edad < 18 || edad > 99) {
            errorFecha.textContent = "La edad debe estar entre 18 y 99 años.";
            fechaInput.classList.add('is-invalid');
            return false;
        } else {
            errorFecha.textContent = "";
            fechaInput.classList.remove('is-invalid');
            return true;
        }
    }

    // Validación al enviar el formulario
    f.addEventListener('submit', e => {
        if (!validarFecha()) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Edad inválida',
                text: 'La edad del cónyuge debe estar entre 18 y 99 años.',
                confirmButtonColor: '#d33'
            });
        }
    });

</script>
@stop


