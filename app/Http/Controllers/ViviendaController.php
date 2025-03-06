<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Persona;

class ViviendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/viviendas');
        $viviendas = $response->json();
        $personas = Persona::all();

        return view('vivienda.index', compact('viviendas', 'personas'));
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

        $usuario_id = auth()->id();
        $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/viviendas', [
            'id_persona' => $request->id_persona,
            'tipo_casa' => $request->tipo_casa,
            'tiempo_vivir' => $request->tiempo_vivir,
            'material_construccion' => $request->material_construccion,
            'pago_vivienda' => $request->pago_vivienda,
            'dependiente' => $request->dependiente,
            'tipo_pago_vivienda' => $request->tipo_pago_vivienda,
            'valor_pago' => $request->valor_pago,
            'direccion_completa' => $request->direccion_completa,
            'creado_por' => $usuario_id,
        ]);

        if ($response->successful()) {
            return redirect()->route('viviendas.index')->with('success', 'Vivienda creada correctamente');
        } else {
            return redirect()->route('viviendas.index')->with('error', 'Ocurrió un error al crear la vivienda');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/viviendas/{$id}");
        $vivienda = $response->json();
        $personas = Persona::all();

        return view('vivienda.edit', compact('vivienda', 'personas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario_id = auth()->id();
        $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/viviendas/{$id}", [
            'id_persona' => $request->id_persona,
            'tipo_casa' => $request->tipo_casa,
            'tiempo_vivir' => $request->tiempo_vivir,
            'material_construccion' => $request->material_construccion,
            'pago_vivienda' => $request->pago_vivienda,
            'dependiente' => $request->dependiente,
            'tipo_pago_vivienda' => $request->tipo_pago_vivienda,
            'valor_pago' => $request->valor_pago,
            'direccion_completa' => $request->direccion_completa,
            'modificado_por' => $usuario_id,
        ]);
    
        if ($response->successful()) {
            return redirect()->route('viviendas.index')->with('success', 'Vivienda actualizada correctamente');
        } else {
            return redirect()->route('viviendas.index')->with('error', 'Ocurrió un error al actualizar la vivienda');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("https://goldfish-app-q3ucp.ondigitalocean.app/api/viviendas/{$id}");

        if ($response->successful()) {
            return redirect()->route('viviendas.index')->with('success', 'Vivienda eliminada correctamente');
        } else {
            return redirect()->route('viviendas.index')->with('error', 'Ocurrió un error al eliminar la vivienda');
        }
    }
}
