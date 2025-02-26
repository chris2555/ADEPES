<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/solicitudes', [
        ]);

            $solicitudes = $response->json();
            return view('Solicitud.index', compact('solicitudes'));
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

        // Enviar datos a la API
        $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/solicitudes', [
            'tipo_garantia' => $request->tipo_garantia,
            'tipo_cuota' => $request->tipo_cuota,
            'tasa' => $request->tasa,
            'plazo' => $request->plazo,
            'monto' => $request->monto,
            'invierte_en' => $request->invierte_en,
            'tipo_credito' => $request->tipo_credito,
            'estado_solicitud' => $request->estado_solicitud,
            'valor_cuota' => $request->valor_cuota,
            'es_aval' => $request->es_aval,
            'creado_por' => $usuario_id,
        ]);


        if ($response->successful()) {
            return redirect()->back()->with('success', 'solicitud creada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al enviar los datos a la API.');
        }
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
        $response = Http::delete("https://goldfish-app-q3ucp.ondigitalocean.app/api/solicitudes/{$id}");

        if ($response->successful()) {
            return redirect()->route('solicitudes.index')->with('success', 'solicitud eliminada correctamente.');
        } else {
            return redirect()->route('solicitudes.index')->with('error', 'No se pudo eliminar la solicitud.');
        }
    }
}
