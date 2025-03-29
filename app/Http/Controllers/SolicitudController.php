<?php

namespace App\Http\Controllers;

use App\Models\SolicitudPrestamo;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Persona;
use Barryvdh\DomPDF\Facade\Pdf;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/solicitudes', []);
            $solicitudes = $response->json();
            $personas = Persona::all();
            return view('Solicitud.index', compact('solicitudes' , 'personas'));
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
            'id_solicitante' => $request->id_persona,
            'nombre_solicitante' => $request->nombres_persona,
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
        $solicitudes = SolicitudPrestamo::findOrFail($id);
        $personas = Persona::all();
        return view('Solicitud.edit', compact( 'solicitudes' , 'personas'));
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
        $usuario_id = auth()->id();
        
        $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/solicitudes/{$id}", [
            'id_solicitante' => $request->id_persona,
            'nombre_solicitante' => $request->nombres_persona,
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
            'modificado_por' => $usuario_id,
        ]);

         if ($response->successful()) {
            return redirect()->route('solicitudes.index')->with('success', 'solicitud actualizada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar los datos en la API.');
        }
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


    public function generarDictamen($id_solicitud)
{
    $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/dictamen/{$id_solicitud}");

    if ($response->successful()) {
        $dictamen = $response->json();

        // Verificar si los datos del dictamen son válidos
        if (empty($dictamen)) {
            return redirect()->back()->with('error', 'No se encontraron datos para el dictamen.');
        }

        // Cargar la vista que contendrá el contenido del PDF
        $pdf = PDF::loadView('relacion.dictamen', compact('dictamen'));
         // Establecer el tamaño del papel
         $pdf->setPaper('A3', 'portrait'); // Puedes cambia

        return $pdf->stream();

    } else {
        return redirect()->back()->with('error', 'No se pudo obtener el dictamen.');
    }
}

public function generarTransunion($id_persona)
    {
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/transunion/{$id_persona}");

        if ($response->successful()) {
            $transunionData = $response->json();
            if (empty($transunionData)) {
                return redirect()->back()->with('error', 'No se encontraron datos de TransUnion.');
            }
            $pdf = PDF::loadView('relacion.transunion', compact('transunionData'));
            $pdf->setPaper('A3', 'portrait');
            return $pdf->stream();
        } else {
            return redirect()->back()->with('error', 'No se pudo obtener la información de TransUnion.');
        }
    }


}
