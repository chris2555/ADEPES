<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Token CSRF para uso con JavaScript -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Restablecer Contraseña</title>
</head>
<body class="h-100">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <img src="https://fundacioncovelo.hn/wp-content/uploads/2020/06/ADEPES.png" alt="logo" width="150">
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <p class="mb-4 text-muted text-sm">
                                ¿Olvidaste tu contraseña? No hay problema. Solo déjanos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña, que te permitirá elegir una nueva.
                            </p>

                            <!-- Mensajes de estado (opcional) -->
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- FORMULARIO -->
                            <form method="POST" action="/forgot-password-email">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label text-muted">Correo Electrónico</label>
        <input id="email" type="email" class="form-control" name="email" required autofocus>
        <div class="invalid-feedback">
            Por favor, ingresa una dirección de correo válida.
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-end mt-4">
        <button type="submit" class="btn btn-success">
            Enviar Enlace de Restablecimiento de Contraseña
        </button>
    </div>
</form>

                        </div>
                        <div class="text-center mt-5 text-muted">
                            Copyright &copy; 2017-2021 &mdash; ADEPES
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
