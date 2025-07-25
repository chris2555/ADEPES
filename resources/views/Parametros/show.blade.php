@extends('adminlte::page')

@section('title', 'Parámetros - Detalles del Parámetro')

@section('content_header')
    <h1><b>Parámetros / Datos del Parámetro</b></h1>
    <hr>
@stop

@section('content')
    <div class='row'>
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Detalles del Parámetro</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id">Clave (ID)</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $parametro->id }}" id="id" disabled readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="valor">Valor</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-cube"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $parametro->valor }}" name="valor" id="valor" disabled readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                    </div>
                                    <textarea name="descripcion" id="descripcion" class="form-control" rows="3" disabled readonly>{{ $parametro->descripcion }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="created_at">Fecha de Creación</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-plus"></i></span>
                                    </div>
                                    {{-- Muestra la fecha formateada --}}
                                    <input type="text" class="form-control" value="{{ $parametro->created_at ? $parametro->created_at->format('d/m/Y H:i:s') : 'N/A' }}" id="created_at" disabled readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updated_at">Última Actualización</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                    </div>
                                    {{-- Muestra la fecha formateada --}}
                                    <input type="text" class="form-control" value="{{ $parametro->updated_at ? $parametro->updated_at->format('d/m/Y H:i:s') : 'N/A' }}" id="updated_at" disabled readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ route('Parametros.index') }}" class="btn btn-dark">Volver al Listado</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- No se necesita CSS adicional específico para esta vista de solo lectura --}}
@stop

@section('js')
    {{-- No se necesita JS adicional para esta vista de solo lectura --}}
@stop