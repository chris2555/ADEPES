<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\PersonaSolicitud;
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
        $responseReferencias = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/referenciasfamiliares');
        $referencias = $responseReferencias->json();

        // Realizar la segunda solicitud HTTP
        $responseSolicitudes = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/personas-solicitudes');
        $solicitudes = $responseSolicitudes->json();
       //dd($referencias, $solicitudes);
        // Pasar ambas variables a la vista
        return view('ReferenciasF.index', compact('referencias', 'solicitudes'));
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
    
        // Validar los datos del formulario
        $request->validate([
            'id_solicitud' => 'required|integer',
            'nombre_familiar' => 'required|string|max:100',
            'parentesco' => 'nullable|string|max:50',
            'direccion_familiar' => 'nullable|string',
        ]);
    
        // Enviar datos a la API
        $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/ReferenciasFamiliares', [
            'id_solicitud' => $request->id_solicitud,
            'nombre_familiar' => $request->nombre_familiar,
            'parentesco' => $request->parentesco ?? null,
            'direccion_familiar' => $request->direccion_familiar ?? null,
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
    try {
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/referenciasfamiliares/{$id}");

        if ($response->successful()) {
            $prestamo = $response->json();
            return view('ReferenciaF.index', compact('referencia'));
        } else {
            Log::error('Error al obtener  la Referencia', ['status' => $response->status()]);
            return redirect()->back()->with('error', 'No se pudo obtener el préstamo');
        }
    } catch (\Exception $e) {
        Log::error('Excepción al obtener la Referencia', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Error interno del servidor');
    }
}

    
public function update(Request $request, $id)
{
    $usuario_id = auth()->id();

    // Validar los datos del formulario
    $request->validate([
        'id_solicitud' => 'required|integer',
        'nombre_familiar' => 'required|string|max:100',
        'parentesco' => 'nullable|string|max:50',
        'direccion_familiar' => 'nullable|string',
    ]);

    // Enviar datos a la API
    $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/referenciasfamiliares/{$id}", [
        'id_solicitud' => $request->id_solicitud,
        'nombre_familiar' => $request->nombre_familiar,
        'parentesco' => $request->parentesco ?? null,
        'direccion_familiar' => $request->direccion_familiar ?? null,
        'modificado_por' => $usuario_id,
    ]);

    if ($response->successful()) {
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false, 'error' => 'Error al actualizar referencia.']);
    }
}
    public function edit($id)
    {
        // Hacer la solicitud a la API para obtener los datos de la referencia
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/referenciasfamiliares/{$id}");
        $referencia = $response->json();
    
        // Validar que la respuesta sea un array y tenga datos
        if (!is_array($referencia) || empty($referencia)) {
            return redirect()->route('referencias.index')->with('error', 'Referencia no encontrada.');
        }
    
        return view('ReferenciasF.edit', compact('referencia'));
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
