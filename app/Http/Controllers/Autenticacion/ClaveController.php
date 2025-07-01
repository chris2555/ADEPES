<?php

namespace App\Http\Controllers\Autenticacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ClaveController extends Controller
{
    /**
     * Actualiza la contraseña del usuario.
     *
     * Este método valida la contraseña actual proporcionada por el usuario,
     * asegura que la nueva contraseña cumpla con las reglas de validación
     * y actualiza la contraseña en la base de datos si es válida.
     *
     * @param Request $request La solicitud HTTP que contiene los datos enviados por el usuario.
     * @return RedirectResponse Respuesta de redirección, normalmente de regreso a la misma página con un mensaje de estado.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validar los datos proporcionados por el usuario.
        $validated = $request->validateWithBag('updatePassword', [
            // La contraseña actual es obligatoria y debe coincidir con la almacenada.
            'current_password' => ['required', 'current_password'],
            // La nueva contraseña es obligatoria, debe cumplir con las reglas predeterminadas y coincidir con su confirmación.
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Actualizar la contraseña del usuario en la base de datos.
        $request->user()->update([
            // Hash::make se utiliza para encriptar la nueva contraseña antes de almacenarla.
            'password' => Hash::make($validated['password']),
        ]);

        // Redirigir de vuelta con un mensaje de estado indicando que la contraseña fue actualizada.
        return redirect()->route('dashboard')->with('status', 'password-updated');
    }
}

