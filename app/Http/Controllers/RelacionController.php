<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Conyuge;
use App\Models\EstadoEgresos;
use App\Models\EstadoIngresos;
use App\Models\SolicitudPrestamo;
use App\Models\RelacionSolicitudPersona;
use Barryvdh\DomPDF\Facade\Pdf;


class RelacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/relacionsolicitudpersona');
        $personas = Persona::where('tipo_persona', 'Solicitante')->get();
        $conyuges = Conyuge::all();
        $solicitudesp = SolicitudPrestamo::all();
        $egresos = EstadoEgresos::all();
        $ingresos = EstadoIngresos::all();
        $avales = Persona::where('tipo_persona', 'Aval')->get();
        $solicitudes = $response->json();
        return view('relacion.index', compact('solicitudes', 'personas', 'avales', 'conyuges', 'egresos', 'ingresos', 'solicitudesp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getConyuge($id)
{
    $conyuge = Conyuge::where('id_persona', $id)->first();

    if ($conyuge) {
        return response()->json([
            'id_conyuge' => $conyuge->id_conyuge,
            'nombres_conyuge' => $conyuge->nombres_conyuge,
            'identidad_conyuge' => $conyuge->identidad_conyuge
        ]);
    } else {
        return response()->json([]);
    }
}


public function getSolicitudes($id_persona)
{
    $solicitudes = SolicitudPrestamo::where('id_persona', $id_persona)->get(['id_solicitud', 'monto']);
    return response()->json($solicitudes);
}

public function getIngresosByPersona($id)
{
    $ingresos = EstadoIngresos::where('id_persona', $id)->first();

    if ($ingresos) {
        return response()->json([
            'id_ingresos' => $ingresos->id_ingresos,
            'total_ingresos' => $ingresos->total_ingresos,
        ]);
    } else {
        return response()->json([]);
    }
}


    


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
        $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/relacionsolicitudpersona', [
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
        $relacion = RelacionSolicitudPersona::findOrFail($id);
        $solicitudes = SolicitudPrestamo::all();
        $personas = Persona::all();
        $conyuges = Conyuge::all();
        $ingresos = EstadoIngresos::all();
        $egresos = EstadoEgresos::all();
        $avales = Persona::all(); 

        return view('relacion.edit', compact('relacion', 'solicitudes', 'personas', 'conyuges', 'ingresos', 'egresos', 'avales'));
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
    $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/relacionsolicitudpersona/{$id}", [
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
        $response = Http::delete("https://goldfish-app-q3ucp.ondigitalocean.app/api/relacionsolicitudpersona/{$id}");

        if ($response->successful()) {
            return redirect()->route('relacion.index')->with('success', 'Relación eliminada correctamente.');
        } else {
            return redirect()->route('relacion.index')->with('error', 'No se pudo eliminar la relación.');
        }
    }


    public function obtenerTablaAmortizacion($id_solicitud)
{
    $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/amortizacion/{$id_solicitud}");

    if ($response->successful()) {
        $amortizacion = $response->json();

        // Verificar si los datos de amortización son válidos
        if (empty($amortizacion)) {
            return redirect()->back()->with('error', 'No se encontraron datos para la tabla de amortización.');
        }

        // Cargar la vista que contendrá el contenido del PDF
        $pdf = PDF::loadView('relacion.amortizacion', compact('amortizacion'));

        return $pdf->stream();

    } else {
        return redirect()->back()->with('error', 'No se pudo obtener la tabla de amortización.');
    }
}
}
