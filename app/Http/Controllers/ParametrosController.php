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
        $response = Http::get('http://127.0.0.1:3000/api/parametros');

        $parametros = $response->successful() ? $response->json() : [];
        $users = User::all();

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
        try {
            $response = Http::post('http://127.0.0.1:3000/api/parametros', [
                'tipo_usuario' => $request->input('tipo_usuario'),
                'clave' => $request->input('clave'),
                'nombre_usuario' => $request->input('nombre_usuario'),
                'descripcion' => $request->input('descripcion'),
            ]);

            if ($response->successful()) {
                return redirect()->route('parametros.index')->with('success', 'Parámetro creado correctamente.');
            } else {
                return redirect()->route('parametros.index')->with('error', 'Error al crear el parámetro.');
            }
        } catch (\Exception $e) {
            return redirect()->route('parametros.index')->with('error', 'Excepción: ' . $e->getMessage());
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
        try {
            $response = Http::put("http://127.0.0.1:3000/api/parametros/{$id}", [
                'tipo_usuario' => $request->input('tipo_usuario'),
                'clave' => $request->input('clave'),
                'nombre_usuario' => $request->input('nombre_usuario'),
                'descripcion' => $request->input('descripcion'),
            ]);

            if ($response->successful()) {
                return redirect()->route('parametros.index')->with('success', 'Parámetro actualizado correctamente.');
            } else {
                return redirect()->route('parametros.index')->with('error', 'Error al actualizar el parámetro.');
            }
        } catch (\Exception $e) {
            return redirect()->route('parametros.index')->with('error', 'Excepción: ' . $e->getMessage());
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
