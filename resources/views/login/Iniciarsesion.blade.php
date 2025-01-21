<head>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="javascript" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="javascript" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-md-7 intro-section">
            <div class="brand-wrapper">
            </div>

            <div class="intro-content-wrapper">

                <center>
                    <h1 class="intro-title">Fondo Rotatorio!</h1>
                </center>
                <p>ADEPES a traves del programa de Desarrollo Sostenibe con Enfoque a Derecho
                    en el marco del proyecto "Jovenes emprendedores fomentando su inclusion social y economica en la
                    MANORCHO"
                    esta impulsando iniciativas del desarrollo economico local para emprendedores, a traves del
                    fortalecimiento
                    de conocimientos y acceso a financiamiento</p>
                <a href="https://api.whatsapp.com/send?phone=%2B50496443207&context=ARCsoktHQuTTtDUTLXWpgVfS7xtgLmJhh0zlRub5JJgXTD2dXYi8si5NUUGF8eVe6epXpqh-ki9K1K84vMTjGJdHafz9zPDrkbpxw5jtoPwdVtkEMW_GcX56XZjL1VpQSb3DXuHrUu_4Z4Fa6ThoXiDpug&source=FB_Page&app=facebook&entry_point=page_cta&fbclid=IwY2xjawH5OR5leHRuA2FlbQIxMAABHZ2h6bXwatibyet_3mvQZMuzWLnXIDRZYH60vN7sv9yB_Ca0pURCV-MyWQ_aem_lZlZ88YAC620OrTG_mJTWw"
                    class="btn btn-read-more">Contactanos</a>
            </div>
            <div class="intro-section-footer">
                <na class="footer-nav">
                    <a href="https://www.facebook.com/adepeshn/photos">Facebook</a>
                    <a href="https://www.instagram.com/adepeshn/?hl=es">Instagram</a>
                </na>
            </div>
        </div>
        <div class="col-sm-6 col-md-5 form-section">
            <div class="login-wrapper">
                <center><img id="logo" class="logo"
                        src="https://fundacioncovelo.hn/wp-content/uploads/2020/06/ADEPES.png" alt="Logotipo de ADEPES">
                </center>
                <br> <br />.
                <h2 class="login-title">Inicio de Sesion</h2>
                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="sr-only">Correo</label>
                        <input id="email" type="email" class="form-control" name="email" :value="old('email')"
                            required autofocus autocomplete="username" placeholder="Correo">
                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="sr-only">Contraseña</label>
                        <input id="password" type="password" class="form-control" name="password" required
                            autocomplete="current-password" placeholder="Contraseña">
                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <button type="submit" class="btn btn-success ms-auto">
                            Iniciar sesión
                        </button>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-password-link">Olvidaste tu
                                contraseña?</a>
                            </a>
                        @endif

                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-5">



                    </div>
                </form>
                <p class="login-wrapper-footer-text">¿Necesitas una cuenta? <a href="{{ route('register') }}"
                        class="text-reset">Regístrate aquí</a></p>
            </div>
        </div>
    </div>
</div>
<style>
    .logo {
        width: 150px;
        /* Ajusta este valor según el tamaño deseado */
        height: auto;
        /* Mantiene la proporción original de la imagen */
    }

    body {
        background-color: #fff;
        font-family: 'Karla', sans-serif;
    }

    h1>a {
        text-decoration: none;
        color: #fff !important;
    }


    .intro-section {
        background-image: url(https://img.freepik.com/vector-gratis/fondo-verde-abstracto_698452-2815.jpg?t=st=1737185978~exp=1737189578~hmac=8309b30bc61d8d481239d1803dd71bb5b83c55528df5978e27353105885ad4fd&w=740);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        padding: 75px 95px;
        min-height: 100vh;
        display: -webkit-box;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        flex-direction: column;
        color: #ffffff;
    }

    @media (max-width: 991px) {
        .intro-section {
            padding-left: 50px;
            padding-rigth: 50px;
        }
    }

    @media (max-width: 767px) {
        .intro-section {
            padding: 28px;
        }
    }

    @media (max-width: 575px) {
        .intro-section {
            min-height: auto;
        }
    }

    .brand-wrapper .logo {
        height: 35px;
    }

    @media (max-width: 767px) {
        .brand-wrapper {
            margin-bottom: 35px;
        }
    }

    .intro-content-wrapper {
        width: 410px;
        max-width: 100%;
        margin-top: auto;
        margin-bottom: auto;
    }

    .intro-content-wrapper .intro-title {
        font-size: 40px;
        font-weight: bold;
        margin-bottom: 17px;
    }

    .intro-content-wrapper .intro-text {
        font-size: 19px;
        line-height: 1.37;
    }

    .intro-content-wrapper .btn-read-more {
        background-color: #fff;
        padding: 13px 30px;
        border-radius: 0;
        font-size: 16px;
        font-weight: bold;
        color: #000;
    }

    .intro-content-wrapper .btn-read-more:hover {
        background-color: transparent;
        border: 1px solid #fff;
        color: #fff;
    }

    @media (max-width: 767px) {
        .intro-section-footer {
            margin-top: 35px;
        }
    }

    .intro-section-footer .footer-nav a {
        font-size: 20px;
        font-weight: bold;
        color: inherit;
    }

    @media (max-width: 767px) {
        .intro-section-footer .footer-nav a {
            font-size: 14px;
        }
    }

    .intro-section-footer .footer-nav a+a {
        margin-left: 30px;
    }

    .form-section {
        display: -webkit-box;
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
    }

    @media (max-width: 767px) {
        .form-section {
            padding: 35px;
        }
    }

    .login-wrapper {
        width: 300px;
        max-width: 100%;
    }

    @media (max-width: 575px) {
        .login-wrapper {
            width: 100%;
        }
    }

    .login-wrapper .form-control {
        border: 0;
        border-bottom: 1px solid #e7e7e7;
        border-radius: 0;
        font-size: 14px;
        font-weight: bold;
        padding: 15px 10px;
        margin-bottom: 7px;
    }

    .login-wrapper .form-control::-webkit-input-placeholder {
        color: #b0adad;
    }

    .login-wrapper .form-control::-moz-placeholder {
        color: #b0adad;
    }

    .login-wrapper .form-control:-ms-input-placeholder {
        color: #b0adad;
    }

    .login-wrapper .form-control::-ms-input-placeholder {
        color: #b0adad;
    }

    .login-wrapper .form-control::placeholder {
        color: #b0adad;
    }

    .login-title {
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .login-btn {
        padding: 13px 30px;
        background-color: #000;
        border-radius: 0;
        font-size: 20px;
        font-weight: bold;
        color: #fff;
    }

    .login-btn:hover {
        border: 1px solid #000;
        background-color: transparent;
        color: #000;
    }

    .forgot-password-link {
        font-size: 14px;
        color: #080808;
        text-decoration: underline;
    }

    .social-login-title {
        font-size: 15px;
        color: #919aa3;
        display: -webkit-box;
        display: flex;
        margin-bottom: 23px;
    }

    .social-login-title::before,
    .social-login-title::after {
        content: "";
        background-image: -webkit-gradient(linear, left top, left bottom, from(#f4f4f4), to(#f4f4f4));
        background-image: linear-gradient(#f4f4f4, #f4f4f4);
        -webkit-box-flex: 1;
        flex-grow: 1;
        background-size: calc(100% - 20px) 1px;
        background-repeat: no-repeat;
    }

    .social-login-title::before {
        background-position: center left;
    }

    .social-login-title::after {
        background-position: center right;
    }

    .social-login-links {
        text-align: center;
        margin-bottom: 32px;
    }

    .social-login-link img {
        width: 40px;
        height: 40px;
        -o-object-fit: contain;
        object-fit: contain;
    }

    .social-login-link+.socia-login-link {
        margin-left: 16px;
    }

    .login-wrapper-footer-text {
        font-size: 14px;
        text-align: center;
    }
</style>
