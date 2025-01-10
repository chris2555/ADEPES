<?php

namespace App\Http\Controllers\Autenticacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmarClaveController extends Controller
{
    /**
     * Muestra la vista para confirmar la contraseña del usuario.
     *
     * @return View La vista que contiene el formulario para confirmar la contraseña.
     */
    public function show(): View
    {
        // Retorna la vista 'login.confirmar-clave', donde el usuario debe ingresar su contraseña.
        return view('login.confirmar-clave');
    }

    /**
     * Confirma la contraseña del usuario.
     *
     * @param Request $request La solicitud HTTP que contiene la contraseña ingresada por el usuario.
     * @return RedirectResponse Redirección al destino previsto tras confirmar la contraseña.
     * @throws ValidationException Si la contraseña no coincide con la del usuario autenticado.
     */
    public function store(Request $request): RedirectResponse
    {
        // Valida que la contraseña proporcionada sea correcta usando el guard de autenticación 'web'.
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email, // Obtiene el correo electrónico del usuario autenticado.
            'password' => $request->password,  // Contraseña proporcionada por el usuario.
        ])) {
            // Si la validación falla, lanza una excepción con un mensaje de error personalizado.
            throw ValidationException::withMessages([
                'password' => __('auth.password'), // Traducción del mensaje de error para la contraseña.
            ]);
        }

        // Si la contraseña es válida, almacena la marca de tiempo actual en la sesión.
        // Esto indica que la contraseña fue confirmada recientemente.
        $request->session()->put('auth.password_confirmed_at', time());

        // Redirige al destino previsto (o al dashboard si no hay uno definido).
        return redirect()->intended(route('dashboard', absolute: false));
    }
}
