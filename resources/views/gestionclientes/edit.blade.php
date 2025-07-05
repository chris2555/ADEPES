@extends('adminlte::page')


@section('title', 'Editar Cliente')


@section('Clientes', 'Editar Cliente')

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
                        <h3 class="card-title">Clientes / Modificar Cliente</h3>

<div class='row'> 
    <div class="col-md-12">
            <div class="card card-outline card-success">
              <div class="card-header">
              <h3 class="card-title">Llene los datos del formulario</h3>
                        </div>
                        <div class="card-body">
            <form action="{{ route('gestionclientes.update', $personas['id_persona']) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Primera columna -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="nombres_apellidos">Nombre Completo</label>
                            <input type="text"
                                class="form-control"
                                id="nombres_apellidos"
                                name="nombres_apellidos"
                                placeholder="Ingrese el nombre completo"
                                required
                                maxlength="80"
                                pattern="^[A-Za-zÁÉÍÓÚÑáéíóúñ\s]+$"
                                title="Solo se permiten letras y espacios."
                                oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚÑáéíóúñ\s]/g, '')"
                                value="{{ $personas['nombres_apellidos'] }}"
                                require>

                            <div class="text-danger" id="error_nombre"></div>
                            </div>
                        <div class="mb-3">
                                <label for="n_identidad" class="form-label">Número de Identidad</label>
                                <input type="text"
                                    class="form-control"
                                    id="n_identidad"
                                    name="n_identidad"
                                    required
                                    minlength="13"
                                    maxlength="13"
                                    pattern="(0[1-9]|1[0-8])[0-9]{2}(19[0-9]{2}|20[0-2][0-9]|2030)[0-9]{5}"
                                    title="Debe tener 13 dígitos: Código de departamento (01-18), y 5 dígitos aleatorios. Ej: 0801199512345"
                                    value="{{ $personas['n_identidad'] }}" 
                                    require>
                                <div class="text-danger" id="error_identidad"></div>
                            </div>
                        <div class="mb-3">
                        <div class="mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date"
                                class="form-control"
                                id="fecha_nacimiento"
                                name="fecha_nacimiento"
                                value="{{ \Carbon\Carbon::parse($personas['fecha_nacimiento'])->format('Y-m-d') }}"
                                required
                                max="{{ \Carbon\Carbon::now()->subYears(18)->format('Y-m-d') }}">
                        </div>

                        <div class="mb-3">
                            <label for="edad" class="form-label">Edad</label>
                            <input type="number"
                                class="form-control"
                                id="edad"
                                name="edad"
                                value="{{ $personas['edad'] }}"
                                readonly>
                        </div>
                   </div>
                   </div>
                     <!-- Segunda columna "-->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                    <input type="text"
                                    class="form-control"
                                    id="nacionalidad"
                                    name="nacionalidad"
                                    required
                                    maxlength="60"
                                    pattern="^[A-Za-zÁÉÍÓÚÑáéíóúñ\s]+$"
                                    title="Solo se permiten letras y espacios."
                                    oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚÑáéíóúñ\s]/g, '')"
                                    value="{{ $personas['nacionalidad'] }}">            
                                </div>
                        <div class="mb-3">
                            <label for="estado_civil" class="form-label">Estado Civil</label>
                            <select class="form-control" id="estado_civil" name="estado_civil">
                                <option value="Soltero" {{ $personas['estado_civil'] == 'Soltero' ? 'selected' : '' }}>Soltero</option>
                                <option value="Casado" {{ $personas['estado_civil'] == 'Casado' ? 'selected' : '' }}>Casado</option>
                                <option value="Divorciado" {{ $personas['estado_civil'] == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                                <option value="Viudo" {{ $personas['estado_civil'] == 'Viudo' ? 'selected' : '' }}>Viudo</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="genero" class="form-label">Género</label>
                            <select class="form-control" id="genero" name="genero">
                                <option value="Masculino" {{ $personas['genero'] == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino" {{ $personas['genero'] == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                <option value="Otro" {{ $personas['genero'] == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tipo_persona" class="form-label">Tipo de persona</label>
                            <select class="form-control" id="tipo_persona" name="tipo_persona">
                                <option value="Solicitante" {{ $personas['tipo_persona'] == 'Solicitante' ? 'selected' : '' }}>Solicitante</option>
                                <option value="Aval" {{ $personas['tipo_persona'] == 'Aval' ? 'selected' : '' }}>Aval</option>
                            </select>
                        </div>

                    </div>
                    <form id="editForm" action="{{ route('gestionclientes.update', $personas['id_persona']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <!-- Columna Izquierda -->
                                <div class="col-md-4">
                                    <x-adminlte-input name="nombres_apellidos" label="Nombre Completo" fgroup-class="mb-3" required
                                        value="{{ old('nombres_apellidos', $personas['nombres_apellidos'] ?? '') }}" />

                                    <x-adminlte-input name="n_identidad" label="Número de Identidad" fgroup-class="mb-3" required
                                        value="{{ old('n_identidad', $personas['n_identidad'] ?? '') }}" />

                                    <x-adminlte-input name="fecha_nacimiento" label="Fecha de Nacimiento" fgroup-class="mb-3" type="date" required
                                        value="{{ \Carbon\Carbon::parse($personas['fecha_nacimiento'])->format('Y-m-d') }}" />

                                    <x-adminlte-input name="edad" label="Edad" fgroup-class="mb-3" type="number" min="0" required
                                        value="{{ old('edad', $personas['edad'] ?? '') }}" />
                                </div>

                                <!-- Columna Central -->
                                <div class="col-md-4">
                                    <x-adminlte-input name="nacionalidad" label="Nacionalidad" fgroup-class="mb-3" required
                                        value="{{ old('nacionalidad', $personas['nacionalidad'] ?? '') }}" />

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

                                    <x-adminlte-input name="telefono_secundario" label="Teléfono" fgroup-class="mb-3"
                                        value="{{ old('telefono_secundario', $personas['telefono_secundario'] ?? '') }}" />
                                </div>
                            </div>
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

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('fecha_nacimiento').addEventListener('change', function () {
        const birthDate = new Date(this.value);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        if (age < 18) {
            alert("Debe tener al menos 18 años.");
            this.value = '';
            document.getElementById('edad').value = '';
        } else {
            document.getElementById('edad').value = age;
        }
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
