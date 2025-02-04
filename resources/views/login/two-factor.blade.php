<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Verificación de Dos Factores</title>
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
                                Ingresa el código de verificación de dos factores que te hemos enviado a tu correo electrónico.
                            </p>


                            <form method="POST" action="{{ route('two-factor.verify') }}" class="needs-validation" novalidate="">
                                @csrf

                                <!-- Código de verificación -->
                                <div class="mb-3">
                                    <label for="code" class="form-label text-muted">Código de Verificación</label>
                                    <input id="code" type="text" class="form-control" name="code" required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor, ingresa un código de verificación válido.
                                    </div>
                                    <strong class="text-danger">{{ $errors->first('code') }}</strong>
                                </div>

                                <div class="d-flex align-items-center justify-content-end mt-4">
                                    <button type="submit" class="btn btn-success">
                                        Verificar Código
                                    </button>
                                </div>
                            </form>

                            @if ($errors->any())
                                <div class="mt-3">
                                    @foreach ($errors->all() as $error)
                                        <p class="text-danger">{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
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
