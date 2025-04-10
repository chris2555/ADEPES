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
    $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/bitacora', [
        'id' => $request->id,
        'nombre_usuario' => $request->nombre_usuario,
        'accion' => $request->accion,
        'modulo' => $request->modulo,
        'fecha_hora' => $request->fecha_hora,
    ]);

    if ($response->successful()) {
        return redirect()->route('bitacoras.index')->with('success', 'Vivienda creada correctamente');
    } else {
        return redirect()->route('bitacoras.index')->with('error', 'Ocurrió un error al crear la vivienda');
    }
}

/**
 * Display the specified resource.
 */
}

