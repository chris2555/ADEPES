<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/personas?sort=id_persona', [
        ]);
        
        
            $personas = $response->json();
            return view('gestionclientes.index', compact('personas'));
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
        $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/personas?sort_by=id_persona&order=asc', [
            'id_persona' => $request->id_persona,
            'nombres_apellidos' => $request->nombres_apellidos,
            'n_identidad' => $request->n_identidad,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'edad' => $request->edad,
            'nacionalidad' => $request->nacionalidad,
            'estado_civil' => $request->estado_civil,
            'genero' => $request->genero,
            'tipo_persona' => $request->tipo_persona,
            'email_personal' => $request->filled('email_personal') ? $request->email_personal : null,
            'email_laboral' => $request->filled('email_laboral') ? $request->email_laboral : null,
            'telefono_secundario' => $request->telefono_secundario,
            'creado_por' => auth()->id(), 
        ]);
        if ($response->successful()) {
            // 1️⃣ Extraer el ID desde la respuesta de la API
            $data = $response->json();
            $idCreado = $data['id_persona' ] ?? 'desconocido';
        
            // 2️⃣ Inyectar el ID al request para que lo use el middleware
            $request->merge([
                '_id_creado_api' => $idCreado,
                '_nombre_creado_api' => $request->nombres_apellidos,
            ]);
            
        
            return redirect()->route('gestionclientes.index')->with('success', 'Cliente creado correctamente');
        }
         else {
            dd($response->status(), $response->body()); // Agregado para depuración
            return redirect()->route('gestionclientes.index')->with('error', 'Ocurrió un error al crear el cliente');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/personas/{$id}");
    $personas = $response->json(); // Renombrar a 'persona'
    return view('gestionclientes.edit', compact('personas')); // Ahora se pasa correctamente
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
        $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/personas/{$id}", [
            'id_persona' => $request->id_persona,
            'nombres_apellidos' => $request->nombres_apellidos,
            'n_identidad' => $request->n_identidad,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'edad' => $request->edad,
            'nacionalidad' => $request->nacionalidad,
            'estado_civil' => $request->estado_civil,
            'genero' => $request->genero,
            'tipo_persona' => $request->tipo_persona,
            'email_personal' => $request->filled('email_personal') ? $request->email_personal : null,
            'email_laboral' => $request->filled('email_laboral') ? $request->email_laboral : null,
            'telefono_secundario' => $request->telefono_secundario,
        ]);

        if ($response->successful()) {
            // 1️⃣ Extraer el ID desde la respuesta de la API
            $data = $response->json();
            $idEditado = $data['id_persona' ] ?? 'desconocido';
        
            // 2️⃣ Inyectar el ID al request para que lo use el middleware
            $request->merge([
                '_id_editado_api' => $idEditado,
                '_nombre_editado_api' => $request->nombres_apellidos,
            ]);
        
            return redirect()->route('gestionclientes.index')->with('success', 'Cliente actualizado correctamente');
        } else {
            return redirect()->route('gestionclientes.index')->with('error', 'Ocurrió un error al actualizar el telefono');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // 1️⃣ Obtener información de la persona para conocer el tipo
    $personaResponse = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/personas/{$id}");

    if ($personaResponse->successful()) {
        $persona = $personaResponse->json();
        $tipoPersona = $persona['tipo_persona'] ?? null;

        // 2️⃣ Intentar eliminar
        $deleteResponse = Http::delete("https://goldfish-app-q3ucp.ondigitalocean.app/api/personas/{$id}");

        if ($deleteResponse->successful()) {
            return redirect()->route('gestionclientes.index')->with('success', 'Cliente eliminado correctamente.');
        } else {
            // 3️⃣ Mostrar mensaje personalizado según el tipo de persona
            if ($tipoPersona === 'Aval') {
                return redirect()->route('gestionclientes.index')->with('error', 'No se puede eliminar el aval porque está relacionado con una solicitud.');
            } else {
                return redirect()->route('gestionclientes.index')->with('error', 'Este cliente tiene una solicitud generada no se puede eliminar.');
            }
        }
    } else {
        return redirect()->route('gestionclientes.index')->with('error', 'No se pudo obtener la información del cliente.');
    }
}

}
