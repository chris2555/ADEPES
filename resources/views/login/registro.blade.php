@extends('adminlte::page')

@section('title', 'Registro')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">

</div>
@endsection

@section('content')
<section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                    <a href="{{ route('login') }}"> <!-- Debe Llevar al index-->
                    <img src="https://fundacioncovelo.hn/wp-content/uploads/2020/06/ADEPES.png" alt="logo" width="150">
                    </a>

                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                        <h1>Registro</h1>
                            <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                                @csrf

                                <!-- Nombre -->
                                <div class="mb-3">
                                    <label for="name" class="mb-2 text-muted"></label>
                                    <input id="name" type="text" class="form-control" name="name" :value="old('name')" required autofocus autocomplete="name"
                                    placeholder="Nombre">
                                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                </div>

                                <!-- Correo electrónico -->
                                <div class="mb-3">
                                    <label for="email" class="mb-2 text-muted"></label>
                                    <input id="email" type="email" class="form-control" name="email" :value="old('email')" required autocomplete="username"
                                    placeholder="Correo Electrónico">
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                </div>

                                <!-- Contraseña -->
                                <div class="mb-3">
                                    <label for="password" class="mb-2 text-muted"></label>
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password"
                                    placeholder="Contraseña">
                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                </div>

                                <!-- Confirmar contraseña -->
                                <div class="mb-3">
                                    <label for="password_confirmation" class="mb-2 text-muted"></label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Confirmar Contraseña">
                                        <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                                    
                                </div>

                                <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success" style="font-size: 1.1rem; padding: 0.75rem 1.2rem;">
                                     Registrarse
                                </button>
                                </div>
                            </form>
                        </div>
                                <div class="card-footer py-1 border-0">
                                <div class="text-center">
                                ¿Ya tienes una cuenta? <a href="{{ route('login') }}" ¿Ya tienes una cuenta? class="text-success">Inicia sesión</a>
                             </div>
                        </div>
                    </div>
                                <div class="text-center mt-5 text-muted">
                                Copyright &copy; 2024-2025 &mdash; 
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



@section('js')
<script>
    console.log('Registro cargado con éxito');
</script>
@endsection
