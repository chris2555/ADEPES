<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BitacoraMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check()) {
            $method = $request->method(); // GET, POST, PUT, DELETE
            $accion = $this->formarAccion($request, $method);

            if ($accion) {
                $modulo = $this->getModulo($request->path());
                DB::table('Bitacora')->insert([
                    'fecha_hora' => Carbon::now(),
                    'id' => Auth::id(),
                    'accion' => $accion,
                    'modulo' => $modulo,
                ]);
            }
        }

        return $response;
    }

    private function getModulo($path)
    {
        // Ejemplo: 'referencias/5/edit' -> 'Referencias'
        $parts = explode('/', $path);
        return ucfirst($parts[0] ?? 'Desconocido');
    }

    private function formarAccion(Request $request, $method)
{
    $modulo = $this->getModulo($request->path());
    $datoClave = $this->extraerDatoClave($request);

    switch ($method) {
        case 'POST':
            $idCreado = $request->input('_id_creado_api') ?? 'desconocido';
            $nombreCreado = $request->input('_nombre_creado_api') ?? 'registro';
            return "Se creó en $modulo: $nombreCreado (ID $idCreado)";
    
        case 'PUT':
        case 'PATCH':
            $parametros = $request->route()->parameters();
            $idEditado = reset($parametros) ?? 'desconocido';
            $datoClave = $this->extraerDatoClave($request);
            return "Se editó en $modulo: $datoClave (ID $idEditado)";
    
        case 'DELETE':
            $parametros = $request->route()->parameters();
            $id = reset($parametros) ?? 'desconocido';
            return "Se eliminó en $modulo: ID $id";
    
        default:
            return null;
    }
    
}


private function extraerDatoClave(Request $request)
{
    // Extrae el dato más representativo del módulo
    if ($request->has('nombre')) {
        return $request->input('nombre');
    } elseif ($request->has('telefono')) {
        return 'Teléfono ' . $request->input('telefono');
    } elseif ($request->has('descripcion')) {
        return $request->input('descripcion');
    }

    return 'registro';
}

}
