<?php

namespace App\Http\Controllers\Autenticacion;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NuevaClaveController extends Controller
{
    /**
     * Muestra la vista para restablecer la contraseña.
     *
     * @param Request $request La solicitud HTTP que contiene los datos necesarios para la vista.
     * @return View La vista para restablecer la contraseña.
     */
    public function create(Request $request): View
    {
        // Retorna la vista 'login.reset-clave' pasando los datos de la solicitud.
        return view('login.reset-clave', ['request' => $request]);
    }

    /**
     * Maneja la solicitud de restablecimiento de contraseña.
     *
     * @param Request $request La solicitud HTTP que contiene los datos del formulario.
     * @return RedirectResponse Redirección a la página de inicio de sesión o mensaje de error.
     * @throws \Illuminate\Validation\ValidationException Si la validación de los datos falla.
     */
    public function store(Request $request): RedirectResponse
    {
        // Valida los datos de la solicitud.
        $request->validate([
            'token' => ['required'], // El token es obligatorio.
            'email' => ['required', 'email'], // El correo debe ser válido.
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // La contraseña debe ser segura y coincidir con la confirmación.
        ]);

        // Intenta restablecer la contraseña del usuario.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                // Actualiza la contraseña del usuario y genera un nuevo token de "recordarme".
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                // Dispara el evento de restablecimiento de contraseña.
                event(new PasswordReset($user));
            }
        );

        // Si el restablecimiento fue exitoso, redirige al inicio de sesión con un mensaje de éxito.
        // Si falló, regresa a la página anterior con los errores correspondientes.
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
