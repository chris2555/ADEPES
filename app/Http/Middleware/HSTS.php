<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HSTS
{
    /**
     * Manejar una solicitud entrante.
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Solo aplicar si la solicitud es HTTPS
        if ($request->isSecure()) {
            $response->headers->set(
                'Strict-Transport-Security',
                'max-age=31536000; includeSubDomains; preload'
            );
        }

        return $response;
    }
}
