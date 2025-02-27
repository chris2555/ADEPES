<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
                            <h4 class="card-title text-center">Restablecer Contraseña</h4>
                            <form method="POST" action="{{ route('password.store') }}" class="needs-validation" novalidate>
                                @csrf
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label text-muted">Correo Electrónico</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $request->email) }}" required autofocus>
                                    <div class="invalid-feedback">Por favor, ingresa un correo válido.</div>
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password" class="form-label text-muted">Nueva Contraseña</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <div class="invalid-feedback">Por favor, ingresa una contraseña.</div>
                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label text-muted">Confirmar Contraseña</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                    <div class="invalid-feedback">Las contraseñas deben coincidir.</div>
                                    <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                                </div>
                                
                                <div class="d-flex align-items-center justify-content-end mt-4">
                                    <button type="submit" class="btn btn-success">Restablecer Contraseña</button>
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
