<?php

use Illuminate\Http\Request;
use App\Http\Middleware\BitacoraMiddleware;
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
use App\Http\Controllers\BitacoraController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\HelpCenterController;

Route::get('/', function () {
    return view('login.Iniciarsesion');
});

Route::middleware('auth')->group(function () {

    Route::get('/two-factor', [TwoFactorController::class, 'index'])->name('two-factor.index');
    Route::post('/two-factor', [TwoFactorController::class, 'verify'])->name('two-factor.verify');  
      
});






Route::middleware('auth','twofactor')->group(function () { 

    Route::get('/dashboard', function () {
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/estadisticas');
        $data = $response->json();
        return view('dashboard', $data);
    })->name('dashboard');
    Route::get('/api-local/prestamos/por-mes', function () {
    $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/prestamo-grafico');
    return $response->json();
    });
    Route::get('/api-local/prestamos/tipo', function () {
    $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/prestamo-tipo');
    return $response->json();
    });


    Route::middleware(['web', BitacoraMiddleware::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');;
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('roles', AsignarRole::class)->middleware('can:ver-seguridad')->names('roles');
    Route::resource('verroles', RoleController::class)->middleware('can:ver-seguridad')->names('verroles');
    Route::resource('permisos', PermisosController::class)->middleware('can:ver-seguridad')->names('permisos');
    Route::resource('users', UserController::class)->middleware('can:ver-seguridad')->names('users');
    //Route::resource('solicitud', SolicitudPrestamoController::class)->middleware('can:ver-seguridad')->names('solicitud');
    Route::resource('solicitudes', SolicitudController::class)->names('solicitudes');
    Route::post('/egresos', [EstadoegresoController::class, 'store'])->name('Estadoegresos.store');
    Route::resource('egresos', EstadoEgresosController::class)->middleware('can:ver-seguridad')->names('egresos');
    Route::resource('relacion',RelacionController::class)->names('relacion');
    Route::resource('Prestamo', PrestamoController::class)->names('Prestamo');
    Route::get('/prestamos', [PrestamoController::class, 'index'])->name('prestamos.index');
    Route::get('/prestamos/{id}', [PrestamoController::class, 'show'])->name('show');
    Route::post('/prestamos', [PrestamoController::class, 'store'])->name('prestamos.store');
    Route::get('/prestamos/{id}', [PrestamoController::class, 'edit'])->name('prestamos.edit');
    Route::put('/prestamos/{id}', [PrestamoController::class, 'update'])->name('prestamos.update');
    Route::delete('/prestamos/{id}', [PrestamoController::class, 'destroy'])->name('prestamos.destroy');
    Route::resource('/referencias', ReferenciasFController::class)->names('referencias');
    Route::resource('pagos', PagosController::class)->names('pagos');
    Route::resource('telefonos',TelefonoController::class)->names('telefonos');
    Route::resource('conyuge', ConyugeController::class)->names('conyuge');
    Route::resource('viviendas',ViviendaController::class)->names('viviendas');
    Route::resource('gestionclientes', ClientesController::class)->names('gestionclientes');
    Route::resource('parametros',parametrosController::class)->names('Parametros');
    Route::resource('ingresos', IngresosController::class)->names('ingresos');
    Route::get('/amortizacion/{id_solicitud}', [SolicitudController::class, 'obtenerTablaAmortizacion'])->name('amortizacion');
    Route::get('/dictamen/{id_solicitud}', [SolicitudController::class, 'generarDictamen'])->name('dictamen');
    Route::get('/pagado/{id_solicitud}', [PagosController::class, 'obtenerPagos'])->name('pagado');
   Route::get('/recibo/{id_persona}/{id_pago}', [PagosController::class, 'obtenerRecibos'])->name('recibo');
    Route::get('/solicitud/{id_solicitud}', [RelacionController::class, 'generarSolicitudPDF'])->name('solicitud');
    Route::resource('parametros',ParametrosController::class)->names('parametros');
    Route::resource('informacionlaboral',InformacionLaboralController::class)->names('informacionlaboral');
    Route::get('/informacionlaboral', [InformacionLaboralController::class, 'index'])->name('informacionlaboral.index');
    Route::put('/informacionlaboral/{id}', [InformacionLaboralController::class, 'update'])->name('informacionlaboral.update');
    Route::get('/https://goldfish-app-q3ucp.ondigitalocean.app/api/Conyuge/{id}', [RelacionController::class, 'getConyuge']);
    Route::get('/https://goldfish-app-q3ucp.ondigitalocean.app/api/solicitudes/{$id}', [SolicitudController::class, 'getSolicitudes']);
    Route::get('/https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos/{id}', [IngresosController::class, 'getByPersona']);
    Route::resource('bitacoras',BitacoraController::class)->middleware('can:ver-seguridad')->names('bitacoras');
    Route::get('/centro-de-ayuda', [HelpCenterController::class, 'index'])->name('centro-de-ayuda');

    


    Route::get('/api-local/pagos/por-mes', function () {
    $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/pagoss/por-mes');
    return $response->json();
});

    Route::get('/api-local/solicitudes/estadistica', function () {
    $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/solicitudess/estadistica');
    return $response->json();
});

    Route::get('/api-local/personass/pagosDeEstaSemana', function () {
    $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/personass/pagosDeEstaSemana');
    return $response->json();
});

});
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
