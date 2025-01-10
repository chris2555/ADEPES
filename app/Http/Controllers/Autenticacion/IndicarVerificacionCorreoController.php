<?php

namespace App\Http\Controllers\Autenticacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndicarVerificacionCorreoController extends Controller
{
    /**
     * Muestra una indicación para que el usuario verifique su correo electrónico
     * o redirige al dashboard si el correo ya está verificado.
     *
     * @param Request $request La solicitud HTTP que contiene la información del usuario autenticado.
     * @return RedirectResponse|View Redirección al dashboard o vista para verificar el correo.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        // Verifica si el usuario autenticado ya ha confirmado su correo electrónico.
        return $request->user()->hasVerifiedEmail()
            // Si el correo está verificado, redirige al dashboard o al destino previsto.
            ? redirect()->intended(route('dashboard', absolute: false))
            // Si no está verificado, muestra la vista 'login.verificar-email'.
            : view('login.verificar-email');
    }
}
