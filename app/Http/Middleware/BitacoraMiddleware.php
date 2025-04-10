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
            return "Se creó en $modulo: $datoClave";
        case 'PUT':
        case 'PATCH':
            return "Se editó en $modulo: $datoClave";
        case 'DELETE':
            // Obtener el primer parámetro de la ruta
            $parametros = $request->route()->parameters();
            $id = reset($parametros) ?? 'desconocido';
            return "Se eliminó en $modulo: ID $id";
        default:
            return null;
    }
}


    private function extraerDatoClave(Request $request)
    {
        // Acá podés personalizar según los campos que mandás en cada módulo
        if ($request->has('nombre')) {
            return $request->input('nombre');
        } elseif ($request->has('telefono')) {
            return $request->input('telefono');
        } elseif ($request->has('descripcion')) {
            return $request->input('descripcion');
        } elseif ($request->route('id')) {
            return 'ID ' . $request->route('id');
        }

        return 'datos desconocidos';
    }
}
