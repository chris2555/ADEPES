<?php
namespace App\Http\Middleware;

use Closure;

class HSTSHeader
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Aplica solo si es HTTPS
        if ($request->isSecure()) {
            $response->headers->set(
                'Strict-Transport-Security',
                'max-age=31536000; includeSubDomains; preload'
            );
        }

        return $response;
    }
}
