<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentSecurityPolicy
{
   public function handle($request, Closure $next)
{
    $response = $next($request);

    // CSP robusta y protección anti-clickjacking
    $response->headers->set('Content-Security-Policy',
        "default-src 'self'; " .
        "script-src 'self' https://stackpath.bootstrapcdn.com https://cdnjs.cloudflare.com https://fonts.googleapis.com; " .
        "style-src 'self' https://fonts.googleapis.com; " .
        "font-src 'self' https://fonts.gstatic.com; " .
        "img-src 'self' data: https:; " .
        "connect-src 'self'; " .
        "form-action 'self'; " .
        "frame-ancestors 'none'; " . // Protección anti-clickjacking
        "object-src 'none';"
    );
    $response->headers->set('X-Frame-Options', 'DENY');

    return $response;
}

}
