<?php

use App\Http\Controllers\HorasController;
use App\Http\Controllers\AsignarRole;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SolicitudPrestamoController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
  
    Route::resource('roles', AsignarRole::class)->middleware('can:users.index')->names('roles');
    Route::resource('users', UserController::class)->middleware('can:users.index')->names('users');
    Route::resource('solicitud', SolicitudPrestamoController::class)->middleware('can:users.index')->names('solicitud');
});

require __DIR__.'/auth.php';



