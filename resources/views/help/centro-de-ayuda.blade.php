@extends('adminlte::page')

@section('title', 'Centro de Ayuda')

@section('content_header')
<h1 class="text-center">Centro de Ayuda</h1>
@endsection

@section('content')
<div class="container my-4">
    @hasrole('Administrador')
    <div id="accordionAdministrador">

        <div class="card mb-2">
            <div class="card-header bg-success text-white" id="headingAdmin1">
                <h5 class="mb-0">
                    <button class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseAdmin1" aria-expanded="false" aria-controls="collapseAdmin1">
                        Manual Técnico(clic para ampliar)
                    </button>
                </h5>
            </div>

            <div id="collapseAdmin1" class="collapse" aria-labelledby="headingAdmin1" data-parent="#accordionAdministrador">
                <div class="card-body p-0">
                    <iframe src="{{ asset('Manuales/Manual_técnico.pdf') }}" width="100%" height="600px" style="border: none;"></iframe>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-header bg-success text-white" id="headingAdmin2">
                <h5 class="mb-0">
                    <button class="btn btn-link text-white collapsed" data-toggle="collapse" data-target="#collapseAdmin2" aria-expanded="false" aria-controls="collapseAdmin2">
                        Manual de Usuario(clic para ampliar)
                    </button>
                </h5>
            </div>

            <div id="collapseAdmin2" class="collapse" aria-labelledby="headingAdmin2" data-parent="#accordionAdministrador">
                <div class="card-body p-0">
                    <iframe src="{{ asset('Manuales/Manual_usuarios.pdf') }}" width="100%" height="600px" style="border: none;"></iframe>
                </div>
            </div>
        </div>

    </div>
    @endhasrole
</div>


@hasrole('Tecnico')
<div id="accordionTecnico" class="mb-4">
    <div class="card">
        <div class="card-header bg-success text-white" id="headingTecnico">
            <h5 class="mb-0">
                <button class="btn btn-link text-white collapsed" data-toggle="collapse" data-target="#collapseTecnico" aria-expanded="false" aria-controls="collapseTecnico">
                    Manual para Técnicos(clic para ampliar)
                </button>
            </h5>
        </div>

        <div id="collapseTecnico" class="collapse" aria-labelledby="headingTecnico" data-parent="#accordionTecnico">
            <div class="card-body p-0">
                <iframe src="{{ asset('Manuales/Manual_usuarios.pdf') }}" width="100%" height="600px" style="border: none;"></iframe>
            </div>
        </div>
    </div>
</div>
@endhasrole


@hasrole('Contador')
<div id="accordionContador" class="mb-4">
    <div class="card">
        <div class="card-header bg-success text-dark" id="headingContador">
            <h5 class="mb-0">
                <button class="btn btn-link text-dark collapsed" data-toggle="collapse" data-target="#collapseContador" aria-expanded="false" aria-controls="collapseContador">
                    Manual para Contadores(clic para ampliar)
                </button>
            </h5>
        </div>

        <div id="collapseContador" class="collapse" aria-labelledby="headingContador" data-parent="#accordionContador">
            <div class="card-body p-0">
                <iframe src="{{ asset('Manuales/Manual_usuarios.pdf') }}" width="100%" height="600px" style="border: none;"></iframe>
            </div>
        </div>
    </div>
</div>
@endhasrole

</div>
@endsection

@section('css')
<style>
    iframe {
        display: block;
        width: 100%;
        height: 600px;
        border: none;
    }
</style>
@endsection

@section('js')
@endsection