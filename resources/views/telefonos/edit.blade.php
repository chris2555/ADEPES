@extends('adminlte::page')

@section('title', 'Editar Teléfono')

@section('content_header')
    <h1>Editar Teléfono</h1>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Actualizar Teléfono</h3>
                        </div>
                        <form id="editForm" action="{{ route('telefonos.update', $telefono['id_telefono']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <!-- Columna Izquierda -->
                                    <div class="col-md-6">
                                        <!-- Número de Teléfono -->
                                        <x-adminlte-input name="numero" label="Número de Teléfono" fgroup-class="mb-3"
    value="{{ $telefono['numero'] }}" required maxlength="9" id="numero"
    pattern="^[2389]\d{3}-\d{4}$"
    title="El número debe tener el formato ####-#### y comenzar con 2, 3, 8 o 9." />

                                       


                                        <!-- Tipo de Teléfono -->
                                        <x-adminlte-select name="tipo" label="Tipo de Teléfono" fgroup-class="mb-3"
                                            required>
                                            <option value="Residencial"
                                                {{ $telefono['tipo_telefono'] == 'Residencial' ? 'selected' : '' }}>
                                                Residencial</option>
                                            <option value="Celular"
                                                {{ $telefono['tipo_telefono'] == 'Celular' ? 'selected' : '' }}>Celular
                                            </option>
                                            <option value="Trabajo"
                                                {{ $telefono['tipo_telefono'] == 'Trabajo' ? 'selected' : '' }}>Trabajo
                                            </option>
                                        </x-adminlte-select>
                                    </div>

                                    <!-- Columna Derecha -->
                                    <div class="col-md-6">
                                        <!-- Tipo de Entidad -->
                                        <x-adminlte-select name="tipo_entidad" label="Tipo de Entidad" fgroup-class="mb-3"
                                            required>
                                            <option value="Solicitante"
                                                {{ $telefono['tipo_entidad'] == 'Solicitante' ? 'selected' : '' }}>
                                                Solicitante</option>
                                            <option value="Aval"
                                                {{ $telefono['tipo_entidad'] == 'Aval' ? 'selected' : '' }}>Aval</option>
                                            <option value="Conyuge"
                                                {{ $telefono['tipo_entidad'] == 'Conyuge' ? 'selected' : '' }}>Conyuge
                                            </option>
                                            <option value="ReferenciaFamiliar"
                                                {{ $telefono['tipo_entidad'] == 'ReferenciaFamiliar' ? 'selected' : '' }}>
                                                Referencia Familiar</option>
                                        </x-adminlte-select>



                                        <!-- Selección de Persona -->
                                        <div class="col-md-6">
                                            <x-adminlte-select name="id_entidad" label="Seleccionar Persona"
                                                fgroup-class="mb-3" required>
                                                <option value="">Seleccione una persona</option>
                                                @foreach ($personas as $persona)
                                                    <option value="{{ $persona->id_persona }}"
                                                        {{ $persona->id_persona == $telefono['id_entidad'] ? 'selected' : '' }}>
                                                        {{ $persona->nombres_apellidos }} - {{ $persona->n_identidad }}
                                                    </option>
                                                @endforeach
                                            </x-adminlte-select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('telefonos.index') }}" class="btn btn-secondary">Cancelar</a>
                                    <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar"
                                        label="Actualizar Teléfono" theme="success" icon="fas fa-lg fa-save" />
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
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("numero");

    if (input) {
        const error = document.createElement('div');
        error.classList.add('text-danger');
        error.style.fontSize = '0.875rem';
        error.style.display = 'none';
        input.parentElement.appendChild(error);

        // Autoformatear con guion ####-####
        input.addEventListener("input", function () {
            let valor = this.value.replace(/\D/g, '').substring(0, 8);
            if (valor.length > 4) {
                valor = valor.slice(0, 4) + '-' + valor.slice(4);
            }
            this.value = valor;
            error.style.display = 'none';
        });

        // Validar al salir del campo
        input.addEventListener("blur", function () {
            const valor = this.value.trim();
            if (!/^[2389]\d{3}-\d{4}$/.test(valor)) {
                error.textContent = "Debe ingresar 8 dígitos en formato ####-#### y comenzar con 2, 3, 8 o 9.";
                error.style.display = 'block';
            } else {
                error.style.display = 'none';
            }
        });

        // Validar al enviar
        const form = document.getElementById("editForm");
        form.addEventListener("submit", function (event) {
            const valor = input.value.trim();
            const regex = /^[2389]\d{3}-\d{4}$/;
            if (!regex.test(valor)) {
                error.textContent = "Debe ingresar 8 dígitos en formato ####-#### y comenzar con 2, 3, 8 o 9.";
                error.style.display = 'block';
                event.preventDefault();
            } else {
                error.style.display = 'none';
            }
        });
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

