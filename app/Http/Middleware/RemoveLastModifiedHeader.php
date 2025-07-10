<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RemoveLastModifiedHeader
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Eliminar el header Last-Modified
        $response->headers->remove('Last-Modified');

        return $response;
    }
}
