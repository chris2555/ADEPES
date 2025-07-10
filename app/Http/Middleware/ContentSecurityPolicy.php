<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next)
{
    $response = $next($request);

    // Content Security Policy robusto
    $response->headers->set('Content-Security-Policy', 
        "default-src 'self'; " .
        "script-src 'self' https://stackpath.bootstrapcdn.com https://cdnjs.cloudflare.com https://fonts.googleapis.com; " .
        "style-src 'self' https://fonts.googleapis.com; " .
        "font-src 'self' https://fonts.gstatic.com; " .
        "img-src 'self' data: https:; " .
        "connect-src 'self'; " .
        "form-action 'self'; " .
        "frame-ancestors 'none'; " .  // 👈 Protección anti-clickjacking por CSP
        "object-src 'none';"
    );

    // Protección anti-clickjacking clásica (para navegadores viejos)
    $response->headers->set('X-Frame-Options', 'DENY'); // O 'SAMEORIGIN' si lo necesitas

    return $response;
}

}
