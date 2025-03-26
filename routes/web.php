<?php

use App\Http\Controllers\HorasController;
use App\Http\Controllers\AsignarRole;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelacionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\SolicitudPrestamoController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EstadoEgresosController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\ReferenciasFController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\TelefonoController;
use App\Http\Controllers\ViviendaController;
use App\Http\Controllers\ConyugeController;
use App\Models\Conyuge;
use App\Http\Controllers\ParametrosController;

use App\Http\Controllers\IngresosController;

use App\Http\Controllers\InformacionLaboralController;

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login.Iniciarsesion');
});

Route::middleware('auth')->group(function () {

    Route::get('/two-factor', [TwoFactorController::class, 'index'])->name('two-factor.index');
    Route::post('/two-factor', [TwoFactorController::class, 'verify'])->name('two-factor.verify');  
      
});

Route::middleware('auth')->group(function () { 

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
    Route::resource('solicitudes', SolicitudController::class)->middleware('can:ver-seguridad')->names('solicitudes');
    Route::resource('gestionclientes', ClientesController::class)->middleware('can:ver-seguridad')->names('gestionclientes');
    Route::post('/egresos', [EstadoegresoController::class, 'store'])->name('Estadoegresos.store');
    Route::resource('egresos', EstadoEgresosController::class)->middleware('can:ver-seguridad')->names('egresos');
    Route::resource('relacion',RelacionController::class)->middleware('can:ver-seguridad')->names('relacion');
    Route::resource('Prestamo', PrestamoController::class)->middleware('can:ver-seguridad')->names('Prestamo');
    Route::get('/prestamos', [PrestamoController::class, 'index'])->middleware('can:ver-seguridad')->name('prestamos.index');
    Route::get('/prestamos/{id}', [PrestamoController::class, 'show'])->middleware('can:ver-seguridad')->name('show');
    Route::post('/prestamos', [PrestamoController::class, 'store'])->middleware('can:ver-seguridad')->name('prestamos.store');
    Route::get('/prestamos/{id}', [PrestamoController::class, 'edit'])->middleware('can:ver-seguridad')->name('prestamos.edit');
    Route::put('/prestamos/{id}', [PrestamoController::class, 'update'])->middleware('can:ver-seguridad')->name('prestamos.update');
    Route::delete('/prestamos/{id}', [PrestamoController::class, 'destroy'])->middleware('can:ver-seguridad')->name('prestamos.destroy');
    Route::resource('/referencias', ReferenciasFController::class)->middleware('can:ver-seguridad')->names('referencias');
    Route::resource('pagos', PagosController::class)->middleware('can:ver-seguridad')->names('pagos');
    Route::resource('telefonos',TelefonoController::class)->names('telefonos');
    Route::resource('viviendas',ViviendaController::class)->names('viviendas');
    Route::resource('conyuge',ConyugeController::class)->names('conyuge');
    Route::resource('parametros',parametrosController::class)->names('Parametros');
    Route::resource('ingresos', IngresosController::class)->middleware('can:ver-seguridad')->names('ingresos');
    Route::delete('/gestionclientes/{id}', [ClientesController::class, 'destroy'])->name('gestionclientes.destroy');
    Route::get('/amortizacion/{id_solicitud}', [RelacionController::class, 'obtenerTablaAmortizacion'])->name('amortizacion');
    Route::get('/pagado/{id_solicitud}', [PagosController::class, 'obtenerPagos'])->name('pagado');
    Route::get('/dictamen/{id_solicitud}', [SolicitudController::class, 'generarDictamen'])->name('dictamen');
    
    Route::resource('parametros',ParametrosController::class)->names('parametros');
    Route::resource('informacionlaboral',InformacionLaboralController::class)->names('informacionlaboral');

    
});
 

   
//Rutas para configuraciones

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/configuraciones', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('configuraciones.index')->middleware('auth');
Route::get('/configuraciones/create ', [App\Http\Controllers\ConfiguracionController::class, 'create'])->name('configuraciones.create')->middleware('auth');
Route::post('/configuraciones/create ', [App\Http\Controllers\ConfiguracionController::class, 'store'])->name('configuraciones.store')->middleware('auth');
Route::get('/configuraciones/{id}', [App\Http\Controllers\ConfiguracionController::class, 'show'])->name('configuraciones.show')->middleware('auth');
Route::get('/configuraciones/{id}/edit', [App\Http\Controllers\ConfiguracionController::class, 'edit'])->name('configuraciones.edit')->middleware('auth');
Route::put('/configuraciones/{id}', [App\Http\Controllers\ConfiguracionController::class, 'update'])->name('configuraciones.update')->middleware('auth');
Route::delete('/configuraciones/{id}', [App\Http\Controllers\ConfiguracionController::class, 'destroy'])->name('configuraciones.destroy')->middleware('auth');
require __DIR__.'/auth.php';