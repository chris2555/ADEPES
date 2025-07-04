@extends('adminlte::page')

@section('Clientes', 'Editar Cliente')

@section('content_header')
    <h1><b>Clientes/Modificar cliente</b></h1>
    </hr>
@stop

@section('content')
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
                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
       value="{{ \Carbon\Carbon::parse($personas['fecha_nacimiento'])->format('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edad" class="form-label">Edad</label>
                            <input type="number" class="form-control" id="edad" name="edad" value="{{ $personas['edad'] }}" required>
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
                    
                    <!-- Tercera columna -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="email_personal" class="form-label">Email Personal</label>
                            <input type="email" class="form-control" id="email_personal" name="email_personal" value="{{ $personas['email_personal'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="email_laboral" class="form-label">Email Laboral</label>
                            <input type="email" class="form-control" id="email_laboral" name="email_laboral" value="{{ $personas['email_laboral'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="telefono_secundario" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono_secundario" name="telefono_secundario" value="{{ $personas['telefono_secundario'] }}">
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Cambios</button>
                    <a href="{{ route('gestionclientes.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
