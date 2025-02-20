@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1>Editar Cliente</h1>
@stop

@section('content')
    <div class="container">
        <main class="mt-3">
            <form action="{{ route('clientes.update', ['cliente' => $clientes[0]['COD_CLIENTE']]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="COD_CLIENTE" class="form-label">CODIGO CLIENTE</label>
                    <input type="text" class="form-control" id="COD_CLIENTE" name="COD_CLIENTE"
                           value="{{ $clientes[0]['COD_CLIENTE'] }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="DNI_CLIENTE" class="form-label">DNI CLIENTE</label>
                    <input type="text" class="form-control" id="DNI_CLIENTE" name="DNI_CLIENTE"
                           value="{{ $clientes[0]['DNI_CLIENTE'] }}">
                </div>
                 <div class="mb-3">
                    <label for="RTN_CLIENTE" class="form-label">RTN CLIENTE</label>
                    <input type="text" class="form-control" id="RTN_CLIENTE" name="RTN_CLIENTE"
                           value="{{ $clientes[0]['RTN_CLIENTE'] }}">
                </div>
                <div class="mb-3">
                    <label for="NOM_CLIENTE" class="form-label">NOMBRE CLIENTE</label>
                    <input type="text" class="form-control" id="NOM_CLIENTE" name="NOM_CLIENTE"
                           value="{{ $clientes[0]['NOM_CLIENTE'] }}">
                </div>
                <div class="mb-3">
                    <label for="DIR_CLIENTE" class="form-label">DIRRECCION CLIENTE</label>
                    <input type="text" class="form-control" id="DIR_CLIENTE" name="DIR_CLIENTE"
                           value="{{ $clientes[0]['DIR_CLIENTE'] }}">
                </div>
                <div class="mb-3">
                    <label for="TIPO_PAGO" class="form-label">TIPO DE PAGO</label>
                    <input type="text" class="form-control" id="TIPO_PAGO" name="TIPO_PAGO"
                           value="{{ $clientes[0]['TIPO_PAGO'] }}">
                </div>
                <div class="mb-3">
                    <label for="FEC_INGRESO_CLIENTE" class="form-label">FECHA INGRESO</label>
                    <input type="date" class="form-control" id="FEC_INGRESO_CLIENTE" name="FEC_INGRESO_CLIENTE"
                           value="{{ $clientes[0]['FEC_INGRESO_CLIENTE'] }}">
                </div>

                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </main>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
