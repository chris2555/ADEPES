<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Persona;

class ReferenciasFController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/referenciasfamiliares');
        //$personas = Persona::all;
        $referencias = $response->json();
        return view('ReferenciasF.index', compact('referencias'));
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
            'id_persona' => 'required|integer',
            'id_conyuge' => 'nullable|integer',
            'id_ingresos' => 'required|integer',
            'id_egresos' => 'required|integer',
            'id_aval1' => 'nullable|integer',
            'id_aval2' => 'nullable|integer',
            'id_aval3' => 'nullable|integer',
        ]);

        // Enviar datos a la API
        $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/ReferenciasFamiliares', [
            'id_solicitud' => $request->id_solicitud,
            'id_persona' => $request->id_persona,
            'id_conyuge' => $request->id_conyuge,
            'id_ingresos' => $request->id_ingresos,
            'id_egresos' => $request->id_egresos,
            'id_aval1' => $request->id_aval1,
            'id_aval2' => $request->id_aval2,
            'id_aval3' => $request->id_aval3,
            'creado_por' => $usuario_id,
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Relación de solicitud creada correctamente.');
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
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/referenciasfamiliriares/{$id}");

        if ($response->successful()) {
            $prestamo = $response->json();
            return view('ReferenciaF.index', compact('referencia'));
        } else {
            Log::error('Error al obtener el préstamo', ['status' => $response->status()]);
            return redirect()->back()->with('error', 'No se pudo obtener el préstamo');
        }
    } catch (\Exception $e) {
        Log::error('Excepción al obtener el préstamo', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Error interno del servidor');
    }
}

    
    public function update(Request $request, $id)
{
    $usuario_id = auth()->id();

    // Validar los datos del formulario
    $request->validate([
        'id_solicitud' => 'required|integer',
        'id_persona' => 'required|integer',
        'id_conyuge' => 'nullable|integer',
        'id_ingresos' => 'required|integer',
        'id_egresos' => 'required|integer',
        'id_aval1' => 'nullable|integer',
        'id_aval2' => 'nullable|integer',
        'id_aval3' => 'nullable|integer',
    ]);

    // Enviar datos a la API externa
    $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/ReferenciasFamiliares/{$id}", [
        'id_solicitud' => $request->id_solicitud,
        'id_persona' => $request->id_persona,
        'id_conyuge' => $request->id_conyuge,
        'id_ingresos' => $request->id_ingresos,
        'id_egresos' => $request->id_egresos,
        'id_aval1' => $request->id_aval1,
        'id_aval2' => $request->id_aval2,
        'id_aval3' => $request->id_aval3,
        'modificado_por' => $usuario_id,
    ]);

    if ($response->successful()) {
        return redirect()->route('relacion.index')->with('success', 'Relación de solicitud actualizada correctamente.');
    } else {
        return redirect()->back()->with('error', 'Error al actualizar los datos en la API.');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("https://goldfish-app-q3ucp.ondigitalocean.app/api/ReferenciasFamiliares/{$id}");

        if ($response->successful()) {
            return redirect()->route('relacion.index')->with('success', 'Relación eliminada correctamente.');
        } else {
            return redirect()->route('relacion.index')->with('error', 'No se pudo eliminar la relación.');
        }
    }
}
