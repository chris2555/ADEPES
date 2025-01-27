<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SolicitudPrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('prestamo.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('prestamo.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'identidad' => 'required|string|max:20',
        'monto' => 'required|numeric',
        'plazo' => 'required|integer',
        'tasa' => 'required|numeric',
        'actividad' => 'required|string',
        'direccion' => 'required|string',
        'telefono' => 'required|string|max:15',
        'celular' => 'nullable|string|max:15',
        'estado_civil' => 'required|string',
        'dependientes' => 'required|integer',
        'genero' => 'required|string',
        'tipo_credito' => 'required|string',
        'ingreso' => 'required|numeric',
        'gasto_alimentacion' => 'required|numeric',
    ]);

    // Guardar en la BD (crear un modelo `SolicitudPrestamo`)
    \App\Models\SolicitudPrestamo::create($request->all());

    return redirect()->route('solicitud.index')->with('success', 'Solicitud creada con éxito.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
