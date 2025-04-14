<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class BitacoraController extends Controller
{
    public function index()
    {
            // Llamada a la API para obtener las bitácoras
            $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/bitacora');
            $bitacoras = $response->json();
            
            
        return view('bitacora.index', compact('bitacoras'));
    }

public function create()
{
    //
}

/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    $usuario_id = auth()->id();
    $fecha = now();

    // Paso 1: Crear la bitácora en la API externa
    $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/bitacora', [
        'id' => $usuario_id,
        'accion' => 'Se creó en ' . $request->modulo . ': ID pendiente',
        'modulo' => $request->modulo,
    ]);

    if ($response->successful()) {
        $data = $response->json();
        $idCreado = $data['id_bitacora'] ?? 'desconocido';

        // Paso 2: Registrar también en la BD local (si es necesario)
        DB::table('Bitacora')->insert([
            'fecha_hora' => $fecha,
            'id' => $usuario_id,
            'accion' => "Se creó en {$request->modulo}: ID {$idCreado}",
            'modulo' => $request->modulo,
        ]);

        return redirect()->route('bitacoras.index')->with('success', 'Bitácora creada correctamente');
    } else {
        return redirect()->route('bitacoras.index')->with('error', 'Ocurrió un error al registrar en la bitácora');
    }
}
}

/**
 * Display the specified resource.
 **/
