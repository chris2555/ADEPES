@extends('adminlte::page')

@section('title', 'Parámetros - Editando Parámetro')

@section('content_header')
    <h1><b>Parámetros / Modificación de Parámetro</b></h1>
    <hr>
@stop

@section('content')
    <div class='row'>
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Modificar datos del parámetro</h3>
                </div>
                <div class="card-body">
                    {{-- El formulario apunta a la ruta 'Parametros.update' --}}
                    {{-- Usa el id del parámetro que se está editando --}}
                    <form action="{{ route('Parametros.update', $parametro->id) }}" method="post">
                        @csrf
                        @method('PUT') {{-- Importante: Laravel usa PUT para actualizaciones --}}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="id">Clave (ID)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        {{-- El ID (clave) se muestra, pero no se permite modificar --}}
                                        <input type="text" class="form-control" value="{{ old('id', $parametro->id) }}" id="id" readonly disabled>
                                    </div>
                                    <small class="form-text text-muted">La clave del parámetro no se puede modificar.</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="valor">Valor (*)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-cube"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{ old('valor', $parametro->valor) }}" name="valor" id="valor" placeholder="Escriba el valor del parámetro">
                                    </div>
                                    @error('valor')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                        </div>
                                        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Escriba una descripción del parámetro">{{ old('descripcion', $parametro->descripcion) }}</textarea>
                                    </div>
                                    @error('descripcion')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('Parametros.index') }}" class="btn btn-dark">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- No se necesita CSS adicional específico para este formulario si usas estilos de Bootstrap/AdminLTE --}}
@stop

@section('js')
    {{-- No se necesita JS adicional específico para este formulario, a menos que tengas validaciones dinámicas --}}
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Cerrar'
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '{{ session('error') }}',
                confirmButtonText: 'Cerrar'
            });
        </script>
    @endif
@stops