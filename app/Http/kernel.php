<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // 🔒 Middlewares globales (opcional)
    protected $middleware = [
        \App\Http\Middleware\StrictTransportSecurityMiddleware::class, // HSTS
    ];

    // 🧩 Grupos de middlewares por tipo
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\StrictTransportSecurityMiddleware::class,

        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\StrictTransportSecurityMiddleware::class,
        ],
    ];

    // 🎯 Middlewares individuales que puedes usar con ->middleware()
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'twofactor' => \App\Http\Middleware\Verify2FAMiddleware::class,
        'bitacora' => \App\Http\Middleware\BitacoraMiddleware::class,
    ];
}
