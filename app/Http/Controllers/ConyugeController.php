<?php

namespace App\Http\Controllers;

use App\Models\Conyuge;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ConyugeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/Conyuge', []);

        $solicitudes = $response->json();
        return view('Conyuge.index', compact('solicitudes'));
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

        // Enviar datos a la API
        $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/conyuge', [
            'nombres_conyuge' => $request->nombres_conyuge,
            'fecha_nacimiento_conyuge' => $request->fecha_nacimiento_conyuge,
            'identidad_conyuge' => $request->identidad_conyuge,
            'direccion_conyuge' => $request->direccion_conyuge,
            'profesion_oficio_conyuge' => $request->profesion_oficio_conyuge,
            'cargo_conyuge' => $request->cargo_conyuge,
            'ingresos_negocio_conyuge' => $request->ingresos_negocio_conyuge,
            'direccion_trabajo_conyuge' => $request->direccion_trabajo_conyuge,
            'tipo_cliente' => $request->tipo_cliente,
            'tiempo_laborar_conyuge' => $request->tiempo_laborar_conyuge,
            'gastos_alimentacion_conyuge' => $request->gastos_alimentacion_conyuge,
            'estado_credito_conyuge' => $request->estado_credito_conyuge,
            'creado_por' => $usuario_id,
        ]);


        if ($response->successful()) {
            return redirect()->back()->with('success', 'solicitud creada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al enviar los datos a la API.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $solicitudes = Conyuge::findOrFail($id);

        return view('conyuge.edit', compact('solicitudes'));
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

        $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/conyuge/{$id}", [
            'nombres_conyuge' => $request->nombres_conyuge,
            'fecha_nacimiento_conyuge' => $request->fecha_nacimiento_conyuge,
            'identidad_conyuge' => $request->identidad_conyuge,
            'direccion_conyuge' => $request->direccion_conyuge,
            'profesion_oficio_conyuge' => $request->profesion_oficio_conyuge,
            'cargo_conyuge' => $request->cargo_conyuge,
            'ingresos_negocio_conyuge' => $request->ingresos_negocio_conyuge,
            'direccion_trabajo_conyuge' => $request->direccion_trabajo_conyuge,
            'tipo_cliente' => $request->tipo_cliente,
            'tiempo_laborar_conyuge' => $request->tiempo_laborar_conyuge,
            'gastos_alimentacion_conyuge' => $request->gastos_alimentacion_conyuge,
            'estado_credito_conyuge' => $request->estado_credito_conyuge,
            'modificado_por' => $usuario_id,
        ]);

        if ($response->successful()) {
            return redirect()->route('Conyuge.index')->with('success', 'solicitud actualizada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar los datos en la API.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("https://goldfish-app-q3ucp.ondigitalocean.app/api/conyuge/{$id}");

        if ($response->successful()) {
            return redirect()->route('conyuge.index')->with('success', 'solicitud eliminada correctamente.');
        } else {
            return redirect()->route('conyuge.index')->with('error', 'No se pudo eliminar la solicitud.');
        }
    }
}
