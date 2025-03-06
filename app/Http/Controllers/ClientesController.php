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
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/personas', [
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
        $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/personas', [
            'id_persona' => $request->id_persona,
            'nombres_apellidos' => $request->nombres_apellidos,
            'n_identidad' => $request->n_identidad,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'edad' => $request->edad,
            'nacionalidad' => $request->nacionalidad,
            'estado_civil' => $request->estado_civil,
            'genero' => $request->genero,
            'tipo_persona' => $request->tipo_persona,
            'email_personal' => $request->email_personal,
            'email_laboral' => $request->email_laboral,
            'telefono_secundario' => $request->telefono_secundario,
            'creado_por' => auth()->id(), 
        ]);
        if ($response->successful()) {
            return redirect()->route('gestionclientes.index')->with('success', 'Cliente creado correctamente');
        } else {
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
            'email_personal' => $request->email_personal,
            'email_laboral' => $request->email_laboral,
            'telefono_secundario' => $request->telefono_secundario,
        ]);
        
        if ($response->successful()) {
            return redirect()->route('gestionclientes.index')->with('success', 'Telefono actualizado correctamente');
        } else {
            return redirect()->route('gestionclientes.index')->with('error', 'Ocurrió un error al actualizar el telefono');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("https://goldfish-app-q3ucp.ondigitalocean.app/api/personas/{$id}");
    
        if ($response->successful()) {
            return redirect()->route('gestionclientes.index')->with('success', 'Cliente eliminado correctamente');
        } else {
            return redirect()->route('gestionclientes.index')->with('error', 'Ocurrió un error al eliminar el cliente');
        }
    }

    //public function destroy(string $id)
    //{
      //  $response = Http::delete("https://goldfish-app-q3ucp.ondigitalocean.app/api/personas/{$id}");
    
        //dd($response->status(), $response->body()); // Agrega esta línea
  //  }
    
}
