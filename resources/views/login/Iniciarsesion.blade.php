<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-Light">
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start py-5 position-relative">
                <img 
                    src="https://fundacioncovelo.hn/wp-content/uploads/2020/06/ADEPES.png" 
                    alt="Logo ADEPES" 
                    class="img-fluid mb-4 custom-image" 
                    style="position: absolute; top: 0px; left: 80%; transform: translateX(-250%); max-width: 160px;"
                >
                <br>
                <br>
                <h1 class="display-4 fw-bold text-body-emphasis mb-3 mt-5">Iniciar sesión</h1>
                <p class="fs-4 col-lg-10 mx-auto mx-lg-0">
                    Completa el formulario para acceder a tu cuenta de manera segura y rápida.
                </p>
            </div>  
            
            <div class="col-md-10 mx-auto col-lg-5">
                <form method="POST" action="{{ route('login') }}" class="p-4 p-md-5 border rounded-3 bg-body-tertiary needs-validation" novalidate="">
                    @csrf
                    <!-- Dirección de correo -->
                    <div class="form-floating mb-3">
                        <input id="email" type="email" class="form-control" name="email" placeholder="name@example.com" :value="old('email')" required autofocus autocomplete="username">
                        <label for="email">Correo electrónico</label>
                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                    </div>
                    <!-- Contraseña -->
                    <div class="form-floating mb-3">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required autocomplete="current-password">
                        <label for="password">Contraseña</label>
                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                    </div>
                    <!-- Recordarme -->
                    <div class="checkbox mb-3">
                        <label>
                            <input id="remember_me" type="checkbox" name="remember"> Recuérdame
                        </label>
                    </div>
                    <button class="w-100 btn btn-lg btn-success" type="submit">Iniciar sesión</button>
                    <hr class="my-4">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-muted">¿Olvidaste tu contraseña?</a>
                    @endif
                    <div class="mt-3 text-center">
                        ¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-success">Crea una</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

