<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/api/prestamo');
        $prestamos = $response->json(); // Convertir JSON en un array
    
        // Verificar si la API devuelve un array válido
        if (!is_array($prestamos)) {
            $prestamos = []; // Asegurar que la variable es un array
        }
    
        return view('prestamo.Prestamo', compact('prestamos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prestamo.Prestamo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Registrar los datos en los logs sin detener la ejecución
        Log::info('Datos recibidos en el Controller:', $request->except(['_token']));
    
        $usuario_id = auth()->id();
        
        // Validar los datos del formulariox
    
        // Enviar datos a la API sin incluir el token
        $response = Http::post('http://localhost:3000/api/prestamo', [
            'id_persona' => $request->id_persona,
            'total_pagado' => $request->total_pagado,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'tipo' => $request->tipo,
            'monto' => $request->monto,
            'tasa' => $request->tasa,
            'plazo' => $request->plazo,
            'estado' => $request->estado,
            'tipo_garantia' => $request->tipo_garantia,
            'creado_por' => $usuario_id,
        ]);
    
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Préstamo creado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'Error al crear el préstamo.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view('prestamo.Prestamo');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
