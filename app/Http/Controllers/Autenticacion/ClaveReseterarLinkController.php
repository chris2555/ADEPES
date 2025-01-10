<?php

namespace App\Http\Controllers\Autenticacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ClaveReseterarLinkController extends Controller
{
    /**
     * Muestra la vista para solicitar un enlace de restablecimiento de contraseña.
     *
     * @return View La vista de la página donde el usuario puede ingresar su correo electrónico para recuperar la cuenta.
     */
    public function create(): View
    {
        // Retorna la vista 'login.recuperar-cuenta' que contiene el formulario para ingresar el correo electrónico.
        return view('login.recuperar-cuenta');
    }

    /**
     * Procesa la solicitud para enviar un enlace de restablecimiento de contraseña.
     *
     * @param Request $request La solicitud HTTP que contiene el correo electrónico del usuario.
     * @return RedirectResponse Redirección de vuelta con un mensaje de éxito o error.
     * @throws \Illuminate\Validation\ValidationException Si la validación del correo electrónico falla.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validar que el campo 'email' esté presente y sea un correo electrónico válido.
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Intentamos enviar un enlace de restablecimiento de contraseña al correo proporcionado.
        // Password::sendResetLink retorna un estado indicando si el envío fue exitoso o falló.
        $status = Password::sendResetLink(
            $request->only('email') // Extrae únicamente el campo 'email' de la solicitud.
        );

        // Si el estado es Password::RESET_LINK_SENT, redirige con un mensaje de éxito.
        // En caso contrario, redirige con el correo ingresado y muestra un mensaje de error.
        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status)) // Mensaje de éxito.
                    : back()->withInput($request->only('email')) // Mantiene el correo ingresado.
                        ->withErrors(['email' => __($status)]); // Mensaje de error.
    }
}
