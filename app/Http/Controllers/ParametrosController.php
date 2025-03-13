<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use App\Models\Parametros;


class ParametrosController extends Controller



{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hacer la petición a la API externa
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/Parametros');
        
        // Convertir la respuesta en un array asociativo
        $parametros = $response->json(); 
    
        // Pasar la variable correctamente a la vista
        return view('parametros.index', compact('parametros'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/Parametros', [
        'tipo_usuario' => $request->tipo_usuario,
        'clave' => $request->clave,
        'nombre_usuario' => $request->nombre_usuario,
        'creado_en' => $request->creado_en,
        'actualizado_en' => $request->actualizado_en,
        'intento_ingreso' => $request->intento_ingreso,
        'vencimiento_usuario' => $request->vencimiento_usuario,
        'descripcion' => $request->descripcion,
      ]);
     
      if ($response->successful()) {
        return redirect()->route('parametros.index')->with('success', 'Parametro creado correctamente');
      } else {
        return redirect()->route('parametros.index')->with('error', 'Ocurrió un error al crear el Parametro');
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/Parametros/{$id}");
        $parametro = $response->json();
        
        return view('Parametros.edit', compact('parametro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/Parametros/{$id}", [
        'tipo_usuario' => $request->tipo_usuario,
        'clave' => $request->clave,
        'nombre_usuario' => $request->nombre_usuario,
        /*'creado_en' => $request->creado_en,
        'actualizado_en' => $request->actualizado_en,
        'intento_ingreso' => $request->intento_ingreso,
        'vencimiento_usuario' => $request->vencimiento_usuario,*/
        'descripcion' => $request->descripcion,
        ]);
        
        if ($response->successful()) {
            return redirect()->route('parametros.index')->with('success', 'Parametro actualizado correctamente');
        } else {
            return redirect()->route('parametros.index')->with('error', 'Ocurrió un error al actualizar el Parametro');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("https://goldfish-app-q3ucp.ondigitalocean.app/api/Parametros/{$id}");
        if ($response->successful()) {
            return redirect()->route('Parametros.index')->with('success', 'Parametro eliminado correctamente');
        } else {
            return redirect()->route('Parametros.index')->with('error', 'Ocurrió un error al eliminar el Parametro');
        }
    }
}
