<?php

use App\Http\Controllers\HorasController;
use App\Http\Controllers\AsignarRole;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SolicitudPrestamoController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\TwoFactorController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login.Iniciarsesion');
});

Route::middleware('auth')->group(function () {

    Route::get('/two-factor', [TwoFactorController::class, 'index'])->name('two-factor.index');
    Route::post('/two-factor', [TwoFactorController::class, 'verify'])->name('two-factor.verify');  
      
});

Route::middleware('auth','twofactor')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('roles', AsignarRole::class)->middleware('can:ver-seguridad')->names('roles');
    Route::resource('verroles', RoleController::class)->middleware('can:ver-seguridad')->names('verroles');
    Route::resource('permisos', PermisosController::class)->middleware('can:ver-seguridad')->names('permisos');
    Route::resource('users', UserController::class)->middleware('can:ver-seguridad')->names('users');
    Route::resource('solicitud', SolicitudPrestamoController::class)->middleware('can:ver-seguridad')->names('solicitud');
    Route::resource('gestionclientes', ClientesController::class)->middleware('can:ver-seguridad')->names('gestionclientes');
});

require __DIR__.'/auth.php';


