<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HSTSHeader
{

 public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // ✅ Agregar encabezados si es https o entorno local
        if (app()->environment('local') || $request->isSecure()) {
            $response->headers->set(
                'Strict-Transport-Security',
                'max-age=31536000; includeSubDomains; preload'
            );
        }

        // 🔐 Encabezados de seguridad adicionales
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'accelerometer=(), camera=(), geolocation=(), microphone=()');

        return $response;
    }
}
