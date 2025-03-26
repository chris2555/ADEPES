<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class ParametrosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Llamada a la API externa para obtener los parámetros
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/Parametros');

        // Validar que la respuesta fue exitosa
        if ($response->successful()) {
            $parametros = $response->json(); 
        } else {
            $parametros = []; // en caso de error
        }

        // Obtener usuarios del modelo User
        $users = User::all();
    
        // Enviar datos a la vista
        return view('parametros.index', compact('parametros', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('parametros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::post('http://127.0.0.1:3000/api/parametros', [
            'tipo_usuario' => $request->tipo_usuario,
            'clave' => $request->clave,
            'nombre_usuario' => $request->nombre_usuario,
            'descripcion' => $request->descripcion,
        ]);

        if ($response->successful()) {
            return redirect()->route('parametros.index')->with('success', 'Parámetro creado correctamente.');
        } else {
            return redirect()->route('parametros.index')->with('error', 'Ocurrió un error al crear el parámetro.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::get("http://127.0.0.1:3000/api/parametros/{$id}");

        if ($response->successful()) {
            $parametro = $response->json();
            return view('parametros.show', compact('parametro'));
        } else {
            return redirect()->route('parametros.index')->with('error', 'No se pudo obtener el parámetro.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $response = Http::get("http://127.0.0.1:3000/api/parametros/{$id}");

        if ($response->successful()) {
            $parametro = $response->json();
            return view('parametros.edit', compact('parametro'));
        } else {
            return redirect()->route('parametros.index')->with('error', 'No se pudo cargar el formulario de edición.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response = Http::put("http://127.0.0.1:3000/api/parametros/{$id}", [
            'tipo_usuario' => $request->tipo_usuario,
            'clave' => $request->clave,
            'nombre_usuario' => $request->nombre_usuario,
            'descripcion' => $request->descripcion,
        ]);

        if ($response->successful()) {
            return redirect()->route('parametros.index')->with('success', 'Parámetro actualizado correctamente.');
        } else {
            return redirect()->route('parametros.index')->with('error', 'Error al actualizar el parámetro.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("http://127.0.0.1:3000/api/parametros/{$id}");

        if ($response->successful()) {
            return redirect()->route('parametros.index')->with('success', 'Parámetro eliminado correctamente.');
        } else {
            return redirect()->route('parametros.index')->with('error', 'Error al eliminar el parámetro.');
        }
    }
}
