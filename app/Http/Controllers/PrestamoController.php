<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Persona;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/Prestamo');
        $prestamos = $response->json(); // Convertir JSON en un array
    
        // Verificar si la API devuelve un array válido
        if (!is_array($prestamos)) {
            $prestamos = []; // Asegurar que la variable es un array
        }
        $personas = Persona::all();
        return view('prestamo.Prestamo', compact('prestamos', 'personas'));
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
        $request->validate([
            'id_persona' => 'required|integer|min:1',
            'total_pagado' => 'nullable|numeric|min:0',
            'fecha_inicio' => 'required|date',
            'fecha_vencimiento' => 'required|date|after_or_equal:fecha_inicio',
            'tipo' => 'required|string',
            'monto' => 'required|numeric|min:1|max:60000',
            'tasa' => 'required|numeric|min:1|max:12',
            'plazo' => 'required|integer|min:1',
            'estado' => 'required|string',
            'tipo_garantia' => 'required|string',
            'creado_por' => 'required|integer',
        ]);
        // Enviar datos a la API sin incluir el token
        $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/Prestamo', [
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
    try {
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/Prestamo/{$id}");

        if ($response->successful()) {
            $prestamo = $response->json();
            return view('prestamo.Prestamo', compact('prestamo'));
        } else {
            Log::error('Error al obtener el préstamo', ['status' => $response->status()]);
            return redirect()->back()->with('error', 'No se pudo obtener el préstamo');
        }
    } catch (\Exception $e) {
        Log::error('Excepción al obtener el préstamo', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Error interno del servidor');
    }
}

    
    
    /*Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Llamar a la API para obtener los datos del préstamo por ID
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/Prestamo/{$id}");
    
        if ($response->failed()) {
            return redirect()->route('prestamos.index')->with('error', 'Préstamo no encontrado');
        }
    
        $prestamo = $response->json(); // Obtener los datos del préstamo en formato array
    
        // Pasar los datos del préstamo a la vista
        return view('prestamo.Prestamo', compact('prestamo'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $usuario_id = auth()->id();

    // Usar el id_prestamo del formulario en lugar de la URL
    $id_prestamo = $request->input('id_prestamo');

    Log::info('ID recibido para actualización:', ['id_prestamo' => $id_prestamo]);

    $validatedData = $request->validate([
        'id_persona' => 'required|integer',
        'total_pagado' => 'nullable|numeric|min:0',
        'fecha_inicio' => 'required|date',
        'fecha_vencimiento' => 'required|date',
        'tipo' => 'required|string|max:50',
        'monto' => 'required|numeric',
        'tasa' => 'required|numeric',
        'plazo' => 'required|integer',
        'estado' => 'required|in:aprobado,pendiente,rechazado',
        'tipo_garantia' => 'required|in:Fiduciaria,Prendaria,Hipotecaria,Solidaria',
    ]);

    Log::info('Datos validados para actualizar:', $validatedData);

    try {
        //$fecha_inicio = date('Y-m-d', strtotime($request->fecha_inicio));
        //$fecha_vencimiento = date('Y-m-d', strtotime($request->fecha_vencimiento));
        // Enviar el ID correcto a la API externa
        $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/Prestamo/{$id_prestamo}", [
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
            'modificado_por' => $usuario_id,
        ]);

        Log::info('Respuesta de la API:', ['status' => $response->status(), 'body' => $response->body()]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Préstamo actualizado correctamente.');
        } else {
            Log::error('Error al actualizar:', ['status' => $response->status(), 'body' => $response->body()]);
            return redirect()->back()->with('error', 'Error al actualizar el préstamo.');
        }
    } catch (\Exception $e) {
        Log::error('Excepción:', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Hubo un error al procesar la solicitud.');
    }
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Request $request, $id)
{
    $razon = $request->input('razon');

    // Eliminar el préstamo
    DB::table('prestamo')->where('id_prestamo', $id)->delete();

    // Registrar en bitácora con el motivo incluido
    DB::table('bitacora')->insert([
        'fecha_hora' => now(),
        'id' => auth()->user()->id,
        'accion' => 'Se eliminó en Prestamos: ID ' . $id . ' - Motivo: ' . $razon,
        'modulo' => 'Prestamos',
    ]);

    return redirect()->route('prestamos.index')->with('success', 'Préstamo eliminado correctamente.');
}


}
