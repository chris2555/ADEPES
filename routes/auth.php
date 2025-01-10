<?php

use App\Http\Controllers\Autenticacion\SesionAutenticadaController;
use App\Http\Controllers\Autenticacion\ConfirmarClaveController;
use App\Http\Controllers\Autenticacion\VerificarNotificacionCorreoController;
use App\Http\Controllers\Autenticacion\IndicarVerificacionCorreoController;
use App\Http\Controllers\Autenticacion\NuevaClaveController;
use App\Http\Controllers\Autenticacion\ClaveController;
use App\Http\Controllers\Autenticacion\ClaveReseterarLinkController;
use App\Http\Controllers\Autenticacion\UsuarioRegistradoController;
use App\Http\Controllers\Autenticacion\VerificarCorreoController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('registro', [UsuarioRegistradoController::class, 'create'])
        ->name('register');

    Route::post('registro', [UsuarioRegistradoController::class, 'store']);

    Route::get('inicio', [SesionAutenticadaController::class, 'create'])
        ->name('login');

    Route::post('inicio', [SesionAutenticadaController::class, 'store']);

    Route::get('recuperar-contrasena', [ClaveReseterarLinkController::class, 'create'])
        ->name('password.request');

    Route::post('recuperar-contrasena', [ClaveReseterarLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NuevaClaveController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NuevaClaveController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', IndicarVerificacionCorreoController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerificarCorreoController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [VerificarNotificacionCorreoController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirmar-clave', [ConfirmarClaveController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirmar-clave', [ConfirmarClaveController::class, 'store']);

    Route::put('password', [ClaveController::class, 'update'])->name('password.update');

    Route::post('logout', [SesionAutenticadaController::class, 'destroy'])
        ->name('logout');
});
