<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TwoFactorController extends Controller
{
    public function index() {
        $user = auth()->user();
    
        // Si ya tiene un código, no generar uno nuevo
        if (!$user->two_factor_code) {
            $code = rand(100000, 999999);
            $user->two_factor_code = $code;
            $user->save();
    
            Mail::raw("Tu código de seguridad es $code", function ($message) use ($user) {
                $message->to($user->email)->subject('Código de Autenticación');
            });
        }
    
        return view('login.two-factor');
    }
    


    public function verify(Request $request) {
        $request->validate([
            'code' => 'required|integer',
        ]);
    
        $user = auth()->user();
    
        if ($request->code == $user->two_factor_code) {
            // Autenticación exitosa, borrar código
            $user->two_factor_code = null;
            $user->save();
    
            session(['two_factor_authenticated' => true]);
            return redirect()->intended('/dashboard');
        }
    
        return redirect()->route('two-factor.index')->withErrors(['code' => 'El código proporcionado es incorrecto']);
    }
    
}

