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
                        <h1 class="fs-4 card-title fw-bold mb-4">Verificación de Correo</h1>

                        <!-- Formulario para reenviar correo de verificación -->
                        <form method="POST" action="{{ route('verification.send') }}" class="needs-validation" novalidate>
                            @csrf
                            <div class="mb-4 text-muted">
                                ¡Gracias por registrarte! Antes de comenzar, verifica tu dirección de correo electrónico haciendo clic en el enlace que te enviamos. Si no lo recibiste, con gusto te enviaremos otro.
                            </div>

                            @if (session('status') == 'verification-link-sent')
                                <div class="mb-4 text-success">
                                    Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.
                                </div>
                            @endif

                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-success">
                                    Reenviar correo de verificación
                                </button>
                            </div>
                        </form>

                        <!-- Formulario para cerrar sesión -->
                        <form method="POST" action="{{ route('logout') }}" class="mt-4">
                            @csrf
                            <button type="submit" class="btn btn-link text-muted">
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                    <div class="card-footer py-1 border-0">
                        <div class="text-center text-muted">
                            Copyright &copy; 2017-2021 &mdash; horasvoae
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
