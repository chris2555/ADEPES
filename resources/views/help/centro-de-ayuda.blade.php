@extends('adminlte::page')

@section('title', 'Centro de Ayuda')

@section('content_header')
    <h1>Centro de Ayuda</h1>
@endsection

@section('content')
<div class="container">
    <p>Consulta los manuales directamente desde este sistema, según tu rol.</p>
</div>

{{-- Modal de Centro de Ayuda --}}
@auth
<div class="modal fade" id="helpCenterModal" tabindex="-1" role="dialog" aria-labelledby="helpCenterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="helpCenterModalLabel">
                    <i class="fas fa-info-circle text-primary"></i> Centro de Ayuda
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                @php
                    $role = Auth::user()->role ?? null;
                @endphp

                {{-- Manual de Usuario --}}
                @if($role === 'administrador' || $role === 'contador')
                <div class="mb-4">
                    <h6><i class="fas fa-book-open text-primary"></i> Manual de Usuario</h6>
                    <p>Consulta el manual de usuario directamente aquí:</p>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://drive.google.com/file/d/ID_DEL_ARCHIVO_USUARIO/preview" allowfullscreen></iframe>
                    </div>
                </div>
                @endif

                {{-- Manual Técnico --}}
                @if($role === 'administrador' || $role === 'tecnico')
                <div class="mb-4">
                    <h6><i class="fas fa-cogs text-secondary"></i> Manual Técnico</h6>
                    <p>Consulta el manual técnico directamente aquí:</p>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://drive.google.com/file/d/ID_DEL_ARCHIVO_TECNICO/preview" allowfullscreen></iframe>
                    </div>
                </div>
                @endif

                {{-- Sin acceso --}}
                @if(!in_array($role, ['administrador', 'contador', 'tecnico']))
                <div class="alert alert-warning mt-3">
                    No tienes acceso a los manuales en este momento.
                </div>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endauth
@endsection

@section('css')
{{-- Puedes agregar estilos personalizados aquí si deseas --}}
@endsection

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $('#helpCenterModal').modal('show'); // Abrir modal automáticamente al cargar la vista
    });
</script>
@endsection
