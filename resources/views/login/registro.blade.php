
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>

    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Registro</h1>
                            <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                                @csrf

                                <!-- Nombre -->
                                <div class="mb-3">
                                    <label for="name" class="mb-2 text-muted">Nombre</label>
                                    <input id="name" type="text" class="form-control" name="name" :value="old('name')" required autofocus autocomplete="name">
                                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                </div>

                                <!-- Correo electrónico -->
                                <div class="mb-3">
                                    <label for="email" class="mb-2 text-muted">Correo electrónico</label>
                                    <input id="email" type="email" class="form-control" name="email" :value="old('email')" required autocomplete="username">
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                </div>

                                <!-- Contraseña -->
                                <div class="mb-3">
                                    <label for="password" class="mb-2 text-muted">Contraseña</label>
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                </div>

                                <!-- Confirmar contraseña -->
                                <div class="mb-3">
                                    <label for="password_confirmation" class="mb-2 text-muted">Confirmar contraseña</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                                    
                                </div>

                                <div class="d-flex align-items-center">
                                    <a href="{{ route('login') }}" class="text-muted me-auto">
                                        ¿Ya tienes una cuenta?
                                    </a>
                                    <button type="submit" class="btn btn-success ms-auto">
                                        Registrarse
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer py-1 border-0">
                            <div class="text-center">
                                ¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-success">Inicia sesión</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-5 text-muted">
                        Copyright &copy; 2017-2021 &mdash; horasvoae
                    </div>
                </div>
            </div>
        </div>
    </section>


