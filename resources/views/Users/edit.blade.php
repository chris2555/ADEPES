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
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña (Opcional)</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Dejar vacío si no desea cambiarla">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <small id="passwordHelp" class="form-text text-muted">
                        Mínimo 8 caracteres, una mayúscula, un número y un carácter especial.
                    </small>
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
    <style>
        .is-valid {
            border-color: #28a745 !important;
            border-width: 3px !important;
        }

        .is-invalid {
            border-color: #dc3545 !important;
            border-width: 3px !important;
        }
    </style>
@stop



@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('togglePassword');
            const icon = toggleButton.querySelector('i');

            function validatePassword(password) {
                const length = /.{8,}/;
                const uppercase = /[A-Z]/;
                const number = /[0-9]/;
                const special = /[!@#$%^&*(),.?":{}|<>]/;

                return (
                    length.test(password) &&
                    uppercase.test(password) &&
                    number.test(password) &&
                    special.test(password)
                );
            }

            passwordInput.addEventListener('input', function() {
                const value = passwordInput.value;

                if (value === '') {
                    passwordInput.classList.remove('is-valid', 'is-invalid');
                    return;
                }

                if (validatePassword(value)) {
                    passwordInput.classList.add('is-valid');
                    passwordInput.classList.remove('is-invalid');
                } else {
                    passwordInput.classList.add('is-invalid');
                    passwordInput.classList.remove('is-valid');
                }
            });

            toggleButton.addEventListener('click', function() {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        });
    </script>
@stop
