@extends('adminlte::page')

@section('title', 'Editar Parametro')

@section('content_header')
    <h1>Editar Parametros</h1>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Actualizar Parametro</h3>
                        </div>
                        <form id="editForm" action="{{ route('parametros.update', $parametro['id_parametros']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <!-- Columna Izquierda -->
                                    <div class="col-md-6">
                                        <!-- Usuario -->
                                        <x-adminlte-input name="Clave" label="Clave" fgroup-class="mb-3"
                                            value="{{ $parametro['clave'] }}" required />

                                        <!-- Tipo de Usuario -->
                                        <x-adminlte-select name="tipo usuario" label="Tipo de Uusario" fgroup-class="mb-3"
                                            required>
                                            <option value="Administrador"
                                                {{ $parametro['tipo_usuario'] == 'Administrador' ? 'selected' : '' }}>
                                                Administrador</option>
                                            <option value="Contador"
                                                {{ $parametro['tipo_usuario'] == 'Contador' ? 'selected' : '' }}>Contador
                                            </option>
                                            <option value="Tecnico"
                                                {{ $parametro['tipo_usuario'] == 'Tecnico' ? 'selected' : '' }}>Tecnico
                                            </option>
                                        </x-adminlte-select>
                                    </div>
                                        <!-- Columna Derecha -->
                                    <div class="col-md-6">
                                        <!-- Tipo de Entidad -->
                                        <x-adminlte-input name="Nombre usuario" label="Nombre de Usuario" fgroup-class="mb-3"
                                           value="{{ $parametro['nombre_usuario'] }}" required />
                                        <x-adminlte-input name="descripciom" label="Descripcion" fgroup-class="mb-3"
                                        value="{{ $parametro['descripcion'] }}" required />
                                         
                                                            
                                        
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('parametros.index') }}" class="btn btn-secondary">Cancelar</a>
                                    <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar"
                                        label="Actualizar Parametro" theme="success" icon="fas fa-lg fa-save" />
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


