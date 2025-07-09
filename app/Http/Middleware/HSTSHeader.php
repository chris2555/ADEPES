<?php
namespace App\Http\Middleware;

use Closure;

class HSTSHeader
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Solo si es HTTPS
        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // Otros encabezados de seguridad útiles
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'accelerometer=(), camera=(), geolocation=(), microphone=()');

        return $response;
    }
}
