@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
   <h1>Editar Usuario</h1>
@stop

@section('content')
<!-- Formulario de edición de usuario con estilo de card -->
<div class="card card-primary col-md-12">
    <div class="card-header">
        <h3 class="card-title">Editar Usuario</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="card-body col-md-12">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="role">Rol</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="" disabled>Seleccione un rol</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="editor" {{ $user->role == 'editor' ? 'selected' : '' }}>Editor</option>
                    <option value="viewer" {{ $user->role == 'viewer' ? 'selected' : '' }}>Visualizador</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Contraseña (Opcional)</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Dejar vacío si no desea cambiarla">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <!-- Botón de cancelar que redirige a la lista de usuarios -->
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@stop

@section('css')
   
@stop

@section('js')
    
@stop
