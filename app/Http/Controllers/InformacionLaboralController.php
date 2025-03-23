<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;



class InformacionLaboralController extends Controller



{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hacer la petición a la API externa
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/InformacionLaboral');
        
        // Convertir la respuesta en un array asociativo
        $InformacionLaboral = $response->json(); 
    
        // Pasar la variable correctamente a la vista
        return view('informacionlaboral.index', compact('InformacionLaboral'));
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
      $response = Http::post('http://127.0.0.1:3000/api/InformacionLaboral', [
        
        'id_persona' => $request->id_persona,
        'profesion_oficio' => $request->profesion_oficio,
        'actividad' => $request->actividad,
       

        'patrono_negocio' => $request->patrono_negocio,
        'tiempo_laborar' => $request->tiempo_laborar,
        
        'estado_credito' => $request->estado_credito,
        'valor_cuota' => $request->valor_cuota,
        
      ]);
     
      if ($response->successful()) {
        return redirect()->route('informacionlaboral.index')->with('success', 'datos laborales creados correctamente');
      } else {
        return redirect()->route('informacionlaboral.index')->with('error', 'Ocurrió un error al crear los datos laborales ');
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::get("http://127.0.0.1:3000/api/InformacionLaboral/{$id}");
        $informacionlaboral = $response->json();
        
        return view('informacionlaboral.edit', compact('informacionlaboral'));
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
        $response = Http::put("http://127.0.0.1:3000/api/InformacionLaboral/{$id}", [
       'id_informacion_laboral' => $request->id_informacion_laboral,
        'id_persona' => $request->id_persona,
        'profesion_oficio' => $request->profesion_oficio,
        'actividad' => $request->actividad,
        'ingresos_negocio' => $request->ingresos_negocio,
        'direccion_trabajo' => $request->direccion_trabajo,
        'patrono_negocio' => $request->patrono_negocio,
        'tiempo_laborar' => $request->tiempo_laborar,
        'gastos_alimentacion' => $request->gastos_alimentacion,
        'estado_credito' => $request->estado_credito,
        'valor_cuota' => $request->valor_cuota,
        'creado_por' => $request->creado_por,
        'creado_en' => $request->creado_en,
        'modificado_por' => $request->modificado_por,
        'modificado_en' => $request->modificado_en,
        ]);
        
        if ($response->successful()) {
            return redirect()->route('informacionlaboral.index')->with('success', 'Informacion Laboral actualizada correctamente');
        } else {
            return redirect()->route('informacionlaboral.index')->with('error', 'Ocurrió un error al actualizar la Informacion Laboral');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("http://127.0.0.1:3000/api/InformacionLaboral/{$id}");
        if ($response->successful()) {
            return redirect()->route('InformacionLaboral.index')->with('success', 'Informacion Laboral eliminado correctamente');
        } else {
            return redirect()->route('InformacionLaboral.index')->with('error', 'Ocurrió un error al eliminar La informacion Laboral');
        }
    }
}