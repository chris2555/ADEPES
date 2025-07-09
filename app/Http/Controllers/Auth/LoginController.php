<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // <-- Agrega esta línea
use Illuminate\Support\Str;  // <-- Y esta también

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Redirige al usuario después del login de forma segura.
     */
    protected function authenticated(Request $request, $user)
    {
        $intended = session()->pull('url.intended', '/dashboard');

        // Solo permitir rutas internas (empiezan con "/")
        if (!Str::startsWith($intended, '/')) {
            $intended = '/dashboard';
        }

        return redirect($intended);
    }
}
