<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\SolicitudPrestamo;
use Illuminate\Support\Facades\DB;

class ReferenciasFController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Realizar la primera solicitud HTTP
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/referenciasfamiliares');
        $referencias = $response->json();
        $personas = Persona::all();

        // Realizar la segunda solicitud HTTP

       //dd($referencias, $solicitudes);
        // Pasar ambas variables a la vista
        return view('ReferenciasF.index', compact( 'referencias','personas'));
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
        $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/ReferenciasFamiliares', [
            'id_persona' => $request->id_persona,
            'nombres_persona' => $request->nombres_persona,
            'nombre_familiar' => $request->nombre_familiar,
            'parentesco' => $request->parentesco ?? null,
            'direccion_familiar' => $request->direccion_familiar ?? null,
            'nombre_familiardos' => $request->nombre_familiardos,
            'parentesco_dos' => $request->parentesco_dos ?? null,
            'direccion_familiardos' => $request->direccion_familiardos ?? null,
            'creado_por' => $usuario_id,
            'creado_en' => now()->format('Y-m-d H:i:s'), // Fecha actual en formato compatible
        ]);
    
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Referencia familiar creada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al enviar los datos a la API.');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/referenciasfamiliares/{$id}");
        $referencias = $response->json();
        $personas = Persona::all();

        return view('ReferenciasF.edit', compact( 'referencias','personas'));
    }

    public function edit(string $id)
    {
        //
    }

public function update(Request $request, string $id)
{
    $usuario_id = auth()->id();

    // Enviar datos a la API
    $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/referenciasfamiliares/{$id}", [
        'id_persona' => $request->id_persona,
        'nombre_familiar' => $request->nombre_familiar,
        'parentesco' => $request->parentesco ?? null,
        'direccion_familiar' => $request->direccion_familiar ?? null,
        'nombre_familiardos' => $request->nombre_familiardos,
        'parentesco_dos' => $request->parentesco_dos ?? null,
        'direccion_familiardos' => $request->direccion_familiardos ?? null,
        'modificado_por' => $usuario_id,
    ]);

    if ($response->successful()) {
        return redirect()->route('referencias.index')->with('success', 'Conyuge actualizado correctamente.');
    } else {
        return redirect()->route('referencias.index')->with('error', 'Error al actualizar Conyuge.');;
    }
}
   
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("https://goldfish-app-q3ucp.ondigitalocean.app/api/ReferenciasFamiliares/{$id}");

        if ($response->successful()) {
            return redirect()->route('referencias.index')->with('success', 'Referencia eliminada correctamente.');
        } else {
            return redirect()->route('referencias.index')->with('error', 'No se pudo eliminar la Referencia.');
        }
    }
}
