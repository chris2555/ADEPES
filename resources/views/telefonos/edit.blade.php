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
                                            value="{{ $telefono['numero'] }}" required maxlength="8" id="numero"
                                            pattern="[2389][0-9]{7}"
                                            title="El número debe tener 8 dígitos y comenzar con 2, 3, 8 o 9." />
                                        @push('js')
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    document.getElementById("numero").addEventListener("input", function() {
                                                        this.value = this.value.replace(/[^0-9]/g, ''); // Solo permite números
                                                    });
                                                });
                                            </script>
                                        @endpush



                                        <!-- Tipo de Teléfono -->
                                        <x-adminlte-select name="tipo" label="Tipo de Teléfono" fgroup-class="mb-3"
                                            required>
                                            <option value="Residencial"
                                                {{ $telefono['tipo'] == 'Residencial' ? 'selected' : '' }}>
                                                Residencial</option>
                                            <option value="Celular"
                                                {{ $telefono['tipo'] == 'Celular' ? 'selected' : '' }}>Celular
                                            </option>
                                            <option value="Trabajo"
                                                {{ $telefono['tipo'] == 'Trabajo' ? 'selected' : '' }}>Trabajo
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
