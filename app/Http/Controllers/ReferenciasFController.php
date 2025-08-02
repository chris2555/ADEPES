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
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/ReferenciasFamiliares');
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
    
        // Enviar datos a la API https://goldfish-app-q3ucp.ondigitalocean.app/api/ReferenciasFamiliares
        $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/ReferenciasFamiliares', [
            'id_persona' => $request->id_persona,
            'nombres_persona' => $request->nombres_persona,
            'nombre_familiar' => $request->nombre_familiar,
            'parentesco' => $request->parentesco ?? null,
            'direccion_familiar' => $request->direccion_familiar ?? null,
            'nombre_familiardos' => $request->nombre_familiardos ?? null,
            'parentesco_dos' => $request->parentesco_dos ?? null,
            'direccion_familiardos' => $request->direccion_familiardos ?? null,
            'telref1' => $request->telref1 ?? null,
            'telref2' => $request->telref2 ?? null,
            'nombreper1' => $request->nombreper1 ?? null,
            'relacionper1' => $request->relacionper1 ?? null,
            'direccionper1' => $request->direccionper1 ?? null,
            'telrefper1' => $request->telrefper1 ?? null,
            'nombreper2' => $request->nombreper2 ?? null,
            'relacionper2' => $request->relacionper2 ?? null,
            'direccionper2' => $request->direccionper2 ?? null,
            'telrefper2' => $request->telrefper2 ?? null,
            'creado_por' => $usuario_id,
            'creado_en' => now()->format('Y-m-d H:i:s'), // Fecha actual en formato compatible
        ]);
    
        if ($response->successful()) {
            // 1️⃣ Extraer el ID desde la respuesta de la API
            $data = $response->json();
            $idCreado = $data['id_referencia' ] ?? 'desconocido';
        
            // 2️⃣ Inyectar el ID al request para que lo use el middleware
            $persona = Persona::find($request->id_persona);
            $nombrePersona = $persona ? $persona->nombres_apellidos : 'registro';
        
            $request->merge([
                '_id_creado_api' => $idCreado,
                '_nombre_creado_api' => $nombrePersona,
            ]);
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
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/ReferenciasFamiliares/{$id}");
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
    $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/ReferenciasFamiliares/{$id}", [
        'id_persona' => $request->id_persona,
        'nombre_familiar' => $request->nombre_familiar,
        'parentesco' => $request->parentesco ?? null,
        'direccion_familiar' => $request->direccion_familiar ?? null,
        'nombre_familiardos' => $request->nombre_familiardos ?? null,
        'parentesco_dos' => $request->parentesco_dos ?? null,
        'direccion_familiardos' => $request->direccion_familiardos ?? null,
        'telref1' => $request->telref1 ?? null,
        'telref2' => $request->telref2 ?? null,
        'nombreper1' => $request->nombreper1 ?? null,
        'relacionper1' => $request->relacionper1 ?? null,
        'direccionper1' => $request->direccionper1 ?? null,
        'telrefper1' => $request->telrefper1 ?? null,
        'nombreper2' => $request->nombreper2 ?? null,
        'relacionper2' => $request->relacionper2 ?? null,
        'direccionper2' => $request->direccionper2 ?? null,
        'telrefper2' => $request->telrefper2 ?? null,
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
