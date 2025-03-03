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
      $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/telefonos', [
        'id_entidad' => $request->id_entidad,
        'tipo_entidad' => $request->tipo_entidad,
        'tipo' => $request->tipo,
        'numero' => $request->numero,
      ]);
     
      if ($response->successful()) {
        return redirect()->route('telefonos.index')->with('success', 'Telefono creado correctamente');
      } else {
        return redirect()->route('telefonos.index')->with('error', 'Ocurrió un error al crear el telefono');
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
        $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/telefonos/{$id}", [
            'id_entidad' => $request->id_entidad,
            'tipo_entidad' => $request->tipo_entidad,
            'tipo' => $request->tipo,
            'numero' => $request->numero,
        ]);
        
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
