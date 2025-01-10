<?php

namespace App\Http\Controllers\Autenticacion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SesionAutenticadaController extends Controller
{
    /**
     * Muestra la vista de inicio de sesión.
     *
     * @return View La vista para que el usuario inicie sesión.
     */
    public function create(): View
    {
        // Retorna la vista 'login.Iniciarsesion'.
        return view('login.Iniciarsesion');
    }

    /**
     * Maneja una solicitud de autenticación entrante.
     *
     * @param LoginRequest $request La solicitud personalizada que valida las credenciales del usuario.
     * @return RedirectResponse Redirección al dashboard u otra ruta destinada.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentica al usuario utilizando las credenciales proporcionadas.
        $request->authenticate();

        // Regenera la sesión para evitar ataques de fijación de sesión.
        $request->session()->regenerate();

        // Redirige al usuario a la ruta de destino después de iniciar sesión.
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destruye una sesión autenticada.
     *
     * @param Request $request La solicitud HTTP que contiene los datos de la sesión.
     * @return RedirectResponse Redirección a la página principal después del cierre de sesión.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Cierra la sesión del usuario autenticado.
        Auth::guard('web')->logout();

        // Invalida la sesión actual para mayor seguridad.
        $request->session()->invalidate();

        // Regenera el token CSRF para evitar ataques de falsificación de solicitudes.
        $request->session()->regenerateToken();

        // Redirige al usuario a la página principal.
        return redirect('/');
    }
}
