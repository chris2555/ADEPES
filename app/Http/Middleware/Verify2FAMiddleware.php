<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Verify2FAMiddleware
{
    
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && !session('two_factor_authenticated')) {
            return redirect()->route('two-factor.index');
        }
        return $next($request);
    }
}
