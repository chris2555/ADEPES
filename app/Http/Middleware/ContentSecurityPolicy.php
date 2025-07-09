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
            "default-src 'self'; 
             script-src 'self' https://stackpath.bootstrapcdn.com https://cdnjs.cloudflare.com https://fonts.googleapis.com; 
             style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; 
             font-src 'self' https://fonts.gstatic.com; 
             img-src 'self' data: https:;"
        );

        return $response;
    }
}
