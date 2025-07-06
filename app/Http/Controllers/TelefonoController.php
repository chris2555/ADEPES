<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Persona;

class TelefonoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/telefonos');
        $telefonos = $response->json();
        $personas = Persona::all();
        
        return view('telefonos.index', compact('telefonos', 'personas'));
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
      $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/telefonoss', [
        //'id_entidad' => $request->id_entidad,
        'id_persona' => $request->id_persona,
        'tipo_entidad' => $request->tipo_entidad,
        'tipo' => $request->tipo,
        'nombres_persona' => $request->nombres_persona,
        'numero' => $request->numero,
      ]);

      
     //dd($response->body());
      if ($response->successful()) {
            // 1️⃣ Extraer el ID desde la respuesta de la API
            $data = $response->json();
            $idCreado = $data['id_telefono' ] ?? 'desconocido';
        
            // 2️⃣ Inyectar el ID al request para que lo use el middleware
            $persona = Persona::find($request->id_persona);
            $nombrePersona = $persona ? $persona->nombres_apellidos : 'registro';
        
            $request->merge([
                '_id_creado_api' => $idCreado,
                '_nombre_creado_api' => $nombrePersona,
            ]);
            
            return redirect()->route('telefonos.index')->with('success', 'Telefono Creado Correctamente');
          } else {
            return redirect()->route('telefonos.index')->with('error', 'Ocurrió un error al crear el Telefono');
          }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/telefonos/{$id}");
        $telefono = $response->json();
        $personas = Persona::all();  
        return view('telefonos.edit', compact('telefono', 'personas'));
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
        
        $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/phone/{$id}", [
            'id_persona' => $request->id_persona,
            'nombres_persona' => $request->nombres_persona,
            'tipo_entidad' => $request->tipo_entidad,
            'tipo' => $request->tipo,
            'numero' => $request->numero,
        ]);

       // dd($response->body());
        
        if ($response->successful()) {
            return redirect()->route('telefonos.index')->with('success', 'Telefono actualizado correctamente');
        } else {
            return redirect()->route('telefonos.index')->with('error', 'Ocurrió un error al actualizar el telefono');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("https://goldfish-app-q3ucp.ondigitalocean.app/api/telefonos/{$id}");
        if ($response->successful()) {
            return redirect()->route('telefonos.index')->with('success', 'Telefono eliminado correctamente');
        } else {
            return redirect()->route('telefonos.index')->with('error', 'Ocurrió un error al eliminar el telefono');
        }
    }
}
