<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\SolicitudPrestamo;
use App\Models\Persona;

class EstadoEgresosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/Estadoegresos');
        $Estadoegresos = $response->json();
        $personas = Persona::all();
        $solicitudes = SolicitudPrestamo::all();

        return view('egresos.index', compact('Estadoegresos', 'personas', 'solicitudes'));
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
        $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/Estadoegresos', [
            'id_persona' => $request->id_persona,
            'id_egresos' => $request->id_egresos,
            'id_solicitud' => $request->id_solicitud,
            'central_riesgo' => $request->central_riesgo,
            'otro_egresos' => $request->otro_egresos,
            'total_egresos' => $request->total_egresos,
            'creado_por' => $usuario_id,
        ]);

        if ($response->successful()) {
            return redirect()->route('egresos.index')->with('success', 'egreso creado correctamente');
        } else {
            return redirect()->route('egresos.index')->with('error', 'Ocurrió un error al crear la vivienda');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/Estadoegresos/{$id}");
        $Estadoegresos = $response->json();
        $personas = Persona::all();

        return view('egresos.edit', compact('Estadoegresos', 'personas'));
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
        $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/Estadoegresos/{$id}", [
            'id_persona' => $request->id_persona,
            'id_egresos' => $request->id_egresos,
            'id_solicitud' => $request->id_solicitud,
            'central_riesgo' => $request->central_riesgo,
            'otro_egresos' => $request->otro_egresos,
            'total_egresos' => $request->total_egresos,
            'modificado_por' => $usuario_id,
        ]);
    
        if ($response->successful()) {
            return redirect()->route('egresos.index')->with('success', 'egreso actualizado correctamente');
        } else {
            return redirect()->route('egresos.index')->with('error', 'Ocurrió un error al actualizar la vivienda');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("https://goldfish-app-q3ucp.ondigitalocean.app/api/Estadoegresos/{$id}");

if ($response->failed()) {
    dd($response->json()); // Mostrar el error en pantalla
}
    }
}
