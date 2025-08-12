@extends('adminlte::page')

@section('title', 'Crear Roles')

@section('content_header')
<h1><b>Crear Roles</b></h1>
<hr>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Asignar Role</li>
    </ol>
</nav>
@stop

@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* Contenedor principal del formulario alineado a izquierda */
        .form-container {
            max-width: 600px;
            margin: 0; /* Eliminamos el margen automático que centraba */
        }
        
        /* Estilo para las filas del formulario */
        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        /* Etiquetas con ancho fijo */
        .form-label {
            font-weight: bold;
            color: #198754;
            width: 80px; /* Ancho fijo para las etiquetas */
            margin-right: 15px;
        }
        
        /* Contenedor de campos con ancho controlado */
        .form-field {
            flex: 1;
            max-width: 300px; /* Ancho máximo reducido para los selects */
        }
        
        /* Estilo para los selects más compactos */
        .form-select {
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .form-select:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.2rem rgba(25,135,84,.25);
        }
        
        /* Botón estilizado alineado a izquierda */
        .btn-primary {
            background-color: #198754;
            border-color: #198754;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            margin-top: 1rem;
            margin-left: 95px; /* Alineamos con el inicio de los campos */
        }
        
        .btn-primary:hover {
            background-color: #157347;
            border-color: #146c43;
        }
    </style>
</head>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success shadow-sm">
            <div class="card-header">
                <h3 class="card-title"><i class="bi bi-person-plus-fill"></i> Asignar rol</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST" class="form-container">
                    @csrf
                    <div class="form-row">
                        <label for="user_id" class="form-label">Usuario</label>
                        <div class="form-field">
                            <select name="user_id" id="user_id" class="form-select" required>
                                <option value="" selected>Seleccione un usuario</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="role_id" class="form-label">Rol</label>
                        <div class="form-field">
                            <select name="role_id" id="role_id" class="form-select" required>
                                <option value="" selected>Seleccione un rol</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle-fill"></i> Asignar Rol
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
@stop