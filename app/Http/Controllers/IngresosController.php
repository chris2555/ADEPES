<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class IngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ModelResponse = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos");
        
        
        $ingresos = $ModelResponse->json(); 
    
        //dd($pagos);
        return view('ingresos.index', compact('ingresos'));
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
        $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos', [
            'id_solicitud' => $request->id_solicitud,
            'renta_propiedades' => $request->renta_propiedades,
            'remesas' => $request->remesas,
            'aporte_conyuge' => $request->aporte_conyuge,
            'ingresos_sociedad' => $request->ingresos_sociedad,
            'total_ingresos' => $request->total_ingresos,
          ]);
         
          if ($response->successful()) {
            return redirect()->route('ingresos.index')->with('success', 'Estado de Ingresos creado correctamente');
          } else {
            return redirect()->route('ingresos.index')->with('error', 'Ocurrió un error al crear el Estado de Ingresos');
          }



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos/{$id}");
        $ingresos = $response->json();
         
        return view('ingresos.edit', compact('ingresos'));
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
        $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos/{$id}", [
            'id_solicitud' => $request->id_solicitud,
            'renta_propiedades' => $request->renta_propiedades,
            'remesas' => $request->remesas,
            'aporte_conyuge' => $request->aporte_conyuge,
            'ingresos_sociedad' => $request->ingresos_sociedad,
            'total_ingresos' => $request->total_ingresos,
            
        ]);
        
        if ($response->successful()) {
            return redirect()->route('ingresos.index')->with('success', 'Estado de Ingresos actualizado correctamente');
        } else {
            return redirect()->route('ingresos.index')->with('error', 'Ocurrió un error al actualizar el Estado de Ingresos');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos/{$id}");
        if ($response->successful()) {
            return redirect()->route('ingresos.index')->with('success', 'Estado de Ingresos eliminado correctamente');
        } else {
            return redirect()->route('ingresos.index')->with('error', 'Ocurrió un error al eliminar el Estado de Ingresos');
        }
    }
}
