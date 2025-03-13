<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class PagosController extends Controller
{
    
    public function index()
    {
        $ModelResponse = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/pagos");
        
        
        $pagos = $ModelResponse->json(); 
        //dd($pagos);
        return view('pagos.pagos', compact('pagos'));
        
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pagos.pagos');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Registrar los datos en los logs sin detener la ejecución
        Log::info('Datos recibidos en el Controller:', $request->except(['_token']));

        $usuario_id = auth()->id();
        
        // Validar los datos del formularios
    
        // Enviar datos a la API sin incluir el token
        $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/pagos', [
            [
                'id_prestamo' => $request->id_prestamo,
                'id_persona' => $request->id_persona,
                'metodo_pago' => $request->metodo_pago,
                'recibo' => $request->recibo,
                'monto' => $request->monto,
                'intereses' => $request->intereses,
                'fecha' => $request->fecha,
                'creado_por' => $usuario_id,
            ]
            
        ]);
    
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Pago creado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'Error al crear el pago.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/pagos/{$id}");

        if ($response->successful()) {
            $pagos = $response->json();
            
            return view('pagos.edit', compact('pagos'));
        } else {
            Log::error('Error al obtener el pago', ['status' => $response->status()]);
            return redirect()->back()->with('error', 'No se pudo obtener el pagos');
        }
    } catch (\Exception $e) {
        Log::error('Excepción al obtener el pago', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Error interno del servidor');
    }
        
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Llamar a la API para obtener los datos del préstamo por ID
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/pagos/{$id}");
    
        if ($response->failed()) {
            return redirect()->route('pagos.edit')->with('error', 'Pago no encontrado');
        }
    
        $prestamo = $response->json(); // Obtener los datos del préstamo en formato array
    
        // Pasar los datos del préstamo a la vista
        return view('pagos.pagos', compact('pagos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario_id = auth()->id();

    // Usar el id_pagos del formulario en lugar de la URL
    $id_pagos = $request->input('id_pagos');

    Log::info('ID recibido para actualización:', ['id_pagos' => $id_pagos]);

    $validatedData = $request->validate([
        'id_prestamo' => 'required|integer',
        'id_persona' => 'required|integer',
        'metodo_pago' => 'required|in:Efectivo,Transferencia', 
        'recibo' => 'required|string', 
        'monto' => 'required|numeric',
        'intereses' => 'required|numeric',
        'fecha_De_Pago' => 'required|date',
    ]);

    Log::info('Datos validados para actualizar:', $validatedData);

    try {
        // Enviar el ID correcto a la API externa
        $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/pagos/{$id_pagos}", [
            'id_prestamo' => $request->id_prestamo,
            'id_persona' => $request->id_persona,
            'metodo_pago' => $request->metodo_pago,
            'recibo' => $request->recibo,
            'monto' => $request->monto,
            'intereses' => $request->intereses,
            'fecha' => $request->fecha,
            'modificado_por' => $usuario_id,
        ]);

        Log::info('Respuesta de la API:', ['status' => $response->status(), 'body' => $response->body()]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Pago actualizado correctamente.');
        } else {
            Log::error('Error al actualizar:', ['status' => $response->status(), 'body' => $response->body()]);
            return redirect()->back()->with('error', 'Error al actualizar el pago.');
        }
    } catch (\Exception $e) {
        Log::error('Excepción:', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Hubo un error al procesar la solicitud.');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("https://goldfish-app-q3ucp.ondigitalocean.app/api/pagos/{$id}");

        if ($response->successful()) {
            return redirect()->route('pagos.pagos')->with('success', 'Pago eliminado correctamente.');
        } else {
            return redirect()->route('pagos.pagos')->with('error', 'No se pudo eliminar la el pago.');
        }
    
    }
}
