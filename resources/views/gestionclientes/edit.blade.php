@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1>Editar Cliente</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Actualizar Cliente</h3>
                    </div>
                    <form id="editForm" action="{{ route('gestionclientes.update', $personas['id_persona']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <!-- Columna Izquierda -->
                                <div class="col-md-4">
                                    <x-adminlte-input name="nombres_apellidos" id="nombres_apellidos" label="Nombre Completo" fgroup-class="mb-3" required
    value="{{ old('nombres_apellidos', $personas['nombres_apellidos'] ?? '') }}" />
<small id="error-nombre" class="text-danger d-none">Solo se permiten letras y espacios.</small>

                                    <x-adminlte-input name="n_identidad" id="n_identidad" label="Número de Identidad" fgroup-class="mb-3" required
    value="{{ old('n_identidad', $personas['n_identidad'] ?? '') }}" />

<small id="error-identidad" class="text-danger d-none">Debe ingresar exactamente 13 números.</small>


                                    <x-adminlte-input name="fecha_nacimiento" label="Fecha de Nacimiento" fgroup-class="mb-3" type="date" required
                                        value="{{ \Carbon\Carbon::parse($personas['fecha_nacimiento'])->format('Y-m-d') }}" />

                                    <x-adminlte-input name="edad" label="Edad" fgroup-class="mb-3" type="number" min="0" required readonly
                                        value="{{ old('edad', $personas['edad'] ?? '') }}" />
                                </div>

                                <!-- Columna Central -->
                                <div class="col-md-4">
                                    <x-adminlte-input name="nacionalidad" id="nacionalidad" label="Nacionalidad" fgroup-class="mb-3" required
    value="{{ old('nacionalidad', $personas['nacionalidad'] ?? '') }}" />
<small id="error-nacionalidad" class="text-danger d-none">Solo se permiten letras y espacios.</small>


                                    <x-adminlte-select name="estado_civil" label="Estado Civil" fgroup-class="mb-3">
                                        <option value="Soltero" {{ $personas['estado_civil'] == 'Soltero' ? 'selected' : '' }}>Soltero</option>
                                        <option value="Casado" {{ $personas['estado_civil'] == 'Casado' ? 'selected' : '' }}>Casado</option>
                                        <option value="Divorciado" {{ $personas['estado_civil'] == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                                        <option value="Viudo" {{ $personas['estado_civil'] == 'Viudo' ? 'selected' : '' }}>Viudo</option>
                                    </x-adminlte-select>

                                    <x-adminlte-select name="genero" label="Género" fgroup-class="mb-3">
                                        <option value="Masculino" {{ $personas['genero'] == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="Femenino" {{ $personas['genero'] == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                        <option value="Otro" {{ $personas['genero'] == 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </x-adminlte-select>

                                    <x-adminlte-select name="tipo_persona" label="Tipo de Persona" fgroup-class="mb-3">
                                        <option value="Solicitante" {{ $personas['tipo_persona'] == 'Solicitante' ? 'selected' : '' }}>Solicitante</option>
                                        <option value="Aval" {{ $personas['tipo_persona'] == 'Aval' ? 'selected' : '' }}>Aval</option>
                                    </x-adminlte-select>
                                </div>

                                <!-- Columna Derecha -->
                                <div class="col-md-4">
                                    <x-adminlte-input name="email_personal" label="Email Personal" fgroup-class="mb-3" type="email"
                                        value="{{ old('email_personal', $personas['email_personal'] ?? '') }}" />

                                    <x-adminlte-input name="email_laboral" label="Email Laboral" fgroup-class="mb-3" type="email"
                                        value="{{ old('email_laboral', $personas['email_laboral'] ?? '') }}" />

                                    <x-adminlte-input name="telefono_secundario" id="telefono_secundario" label="Teléfono" fgroup-class="mb-3"
    value="{{ old('telefono_secundario', $personas['telefono_secundario'] ?? '') }}" />
<small id="error-telefono" class="text-danger d-none">Debe ingresar un número válido de 8 dígitos.</small>

                                </div>
                            </div>
                             <input type="hidden" name="modificado_por" value="{{ Auth::user()->id }}">
                            <div class="card-footer">
                                <a href="{{ route('gestionclientes.index') }}" class="btn btn-secondary">Cancelar</a>
                                <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar" label="Actualizar Cliente" theme="success" icon="fas fa-lg fa-save" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
@stop

@section('css')

@stop

@section('js')
<script>
    const fechaNacimiento = document.getElementById('fecha_nacimiento');
    const edadInput = document.getElementById('edad');

    fechaNacimiento.addEventListener('change', function () {
        const birthDate = new Date(this.value);
        const today = new Date();
        let edad = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            edad--;
        }

        if (!isNaN(edad)) {
            edadInput.value = edad;
        } else {
            edadInput.value = '';
        }
    });

    document.querySelector('#editForm').addEventListener('submit', function (e) {
        const birthDate = new Date(fechaNacimiento.value);
        const today = new Date();
        let edad = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            edad--;
        }

        if (edad < 18 || edad > 100) {
            e.preventDefault();
            alert('Debes ingresar una fecha válida para una persona entre 18 y 100 años.');
            edadInput.value = '';
        } else {
            edadInput.value = edad;
        }
    });
</script>

<script>
    const identidadInput = document.getElementById('n_identidad');
    const errorIdentidad = document.getElementById('error-identidad');

    identidadInput.addEventListener('input', function () {
        // Elimina letras o símbolos
        this.value = this.value.replace(/\D/g, '');

        // Limita a 13 caracteres
        if (this.value.length > 13) {
            this.value = this.value.slice(0, 13);
        }

        // Oculta el mensaje si se corrige en tiempo real
        if (this.value.length === 13) {
            errorIdentidad.classList.add('d-none');
        }
    });

    document.querySelector('#editForm').addEventListener('submit', function (e) {
        const identidad = identidadInput.value;

        if (identidad.length !== 13) {
            e.preventDefault();

            // Muestra mensaje en rojo
            errorIdentidad.classList.remove('d-none');

            // Opcional: mover el foco al campo con error
            identidadInput.focus();
        } else {
            // Oculta si está correcto
            errorIdentidad.classList.add('d-none');
        }
    });
</script>

<script>
    const nombreInput = document.getElementById('nombres_apellidos');
    const nacionalidadInput = document.getElementById('nacionalidad');
    const telefonoInput = document.getElementById('telefono_secundario');

    const errorNombre = document.getElementById('error-nombre');
    const errorNacionalidad = document.getElementById('error-nacionalidad');
    const errorTelefono = document.getElementById('error-telefono');

    // Validar solo letras y espacios
    function soloLetras(input, errorMsg) {
        input.addEventListener('input', function () {
            const soloLetrasRegex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/;
            if (!soloLetrasRegex.test(this.value)) {
                errorMsg.classList.remove('d-none');
                this.classList.add('is-invalid');
            } else {
                errorMsg.classList.add('d-none');
                this.classList.remove('is-invalid');
            }
        });
    }

    soloLetras(nombreInput, errorNombre);
    soloLetras(nacionalidadInput, errorNacionalidad);

    // Validación del teléfono
    telefonoInput.addEventListener('input', function () {
        let valor = this.value.replace(/\D/g, ''); // Solo números
        if (valor.length > 8) valor = valor.slice(0, 8);
        if (valor.length > 4) {
            valor = valor.slice(0, 4) + '-' + valor.slice(4);
        }
        this.value = valor;
    });

    document.getElementById('editForm').addEventListener('submit', function (e) {
        let valid = true;

        // Validar nombre
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(nombreInput.value)) {
            errorNombre.classList.remove('d-none');
            nombreInput.classList.add('is-invalid');
            valid = false;
        }

        // Validar nacionalidad
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(nacionalidadInput.value)) {
            errorNacionalidad.classList.remove('d-none');
            nacionalidadInput.classList.add('is-invalid');
            valid = false;
        }

        // Validar teléfono
        const telefonoSinGuion = telefonoInput.value.replace(/\D/g, '');
        if (telefonoSinGuion.length !== 8) {
            errorTelefono.classList.remove('d-none');
            telefonoInput.classList.add('is-invalid');
            valid = false;
        } else {
            errorTelefono.classList.add('d-none');
            telefonoInput.classList.remove('is-invalid');
        }

        if (!valid) e.preventDefault();
    });
</script>



@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Cerrar'
        });
    </script>
@endif
@stop