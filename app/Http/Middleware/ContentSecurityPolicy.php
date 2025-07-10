<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('Content-Security-Policy',
    "default-src 'self'; " .
    "script-src 'self' https://stackpath.bootstrapcdn.com https://cdnjs.cloudflare.com; " .
    "style-src 'self' https://fonts.googleapis.com https://stackpath.bootstrapcdn.com; " .
    "font-src 'self' https://fonts.gstatic.com; " .
    "img-src 'self' data: https://img.freepik.com; " .
    "connect-src 'self'; " .
    "form-action 'self'; " .
    "frame-ancestors 'none'; " .
    "object-src 'none'; " .
    "base-uri 'self';"
);

        return $response;
    }
}
