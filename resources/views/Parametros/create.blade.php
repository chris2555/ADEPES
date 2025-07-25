@extends('adminlte::page')

@section('title', 'Parámetros - Crear nuevo Parámetro')

@section('content_header')
    <h1><b>Parámetros / Registro de un nuevo parámetro</b></h1>
    <hr>
@stop

@section('content')
    <div class='row'>
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Llene los datos del formulario</h3>
                </div>
                <div class="card-body">
                    {{-- The action will point to the store method of your ParametroController --}}
                    <form action="{{ route('Parametros.store') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="valor">Valor (*)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-cube"></i></span>
                                        </div>
                                        {{-- Use old('valor') to repopulate the field if there's a validation error --}}
                                        <input type="text" class="form-control" name="valor" id="valor" placeholder="Ingrese el valor del parámetro" value="{{ old('valor') }}" required>
                                    </div>
                                    @error('valor')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion">Descripción (*)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                        </div>
                                        {{-- Use old('descripcion') to repopulate the field --}}
                                        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Escriba una descripción del parámetro" required>{{ old('descripcion') }}</textarea>
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
                                    {{-- The cancel button should go back to the index page for Parameters --}}
                                    <a href="{{ route('Parametros.index') }}" class="btn btn-dark">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Registrar Parámetro</button>
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
    {{-- No se necesita CSS adicional específico para esta vista. Tu CSS personalizado para DataTables no aplica aquí. --}}
@stop

@section('js')
    {{-- No se necesita JS adicional para esta vista de creación. Tu script de DataTables no aplica aquí. --}}
@stop