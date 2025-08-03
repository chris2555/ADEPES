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
use Carbon\Carbon;
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


public function getByPersona($id)
{
    $ingreso = DB::table('EstadoIngresos')
        ->where('id_persona', $id)
        ->select('id_ingresos', 'total_ingresos','total_egresos')
        ->get();


    if (!$ingreso) {
        return response()->json([]);
    }

    return response()->json($ingreso);
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
            'id_solicitud' => 'nullable|integer',
            'id_persona' => 'required|integer',
            'id_conyuge' => 'nullable|integer',
            'id_ingresos' => 'nullable|integer',
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
            'id_aval1' => $request->id_aval1,
            'id_aval2' => $request->id_aval2,
            'id_aval3' => $request->id_aval3,
            'creado_por' => $usuario_id,
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Relacion creada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al crear relacion.');
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
        $avales = Persona::where('tipo_persona', 'Aval')->get();
        
        return view('relacion.edit', compact('relacion', 'solicitudes', 'personas', 'conyuges', 'ingresos', 'egresos', 'avales'));
    }

    
    public function update(Request $request, $id)
{
    $usuario_id = auth()->id();

    // Validar los datos del formulario
    $request->validate([
        'id_solicitud' => 'nullable|integer',
        'id_persona' => 'required|integer',
        'id_conyuge' => 'nullable|integer',
        'id_ingresos' => 'nullable|integer',
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
    $errorMsg = $response->json('message') ?? 'Error al actualizar la solicitud.';
    return redirect()->back()->withInput()->with('error', $errorMsg);
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
    } elseif ($response->status() === 400 && $response->json('error')) {
        // Este es el mensaje personalizado del trigger
        return redirect()->route('relacion.index')->with('error', $response->json('error'));
    } else {
        return redirect()->route('relacion.index')->with('error', 'No se pudo eliminar la relación.');
    }
}



public function generarSolicitudPDF($id_solicitud)
{
    // Obtener todas las relaciones desde la API
    $relaciones = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/relacionsolicitudpersona')->json();

    // Buscar la relación que coincida con el id_solicitud dado
    $relacion = collect($relaciones)->firstWhere('id_solicitud', (int) $id_solicitud);

    if (!$relacion) {
        abort(404, 'Solicitud no encontrada.');
    }

    // Asegurarte de que el id_persona esté presente
    if (!isset($relacion['id_persona'])) {
        abort(500, 'La relación no contiene id_persona.');
    }

    $id_persona = $relacion['id_persona'];

    // Obtener datos de persona
    $persona = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/personas/{$id_persona}")->json();

    // Buscar cónyuge
    $conyuges = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/Conyuge")->json();
    $conyuge = collect($conyuges)->firstWhere('id_persona', $id_persona);

      // Buscar cónyuge
      $viviendas = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/viviendas")->json();
      $vivienda = collect($viviendas)->firstWhere('id_persona', $id_persona);

    $InformacionLaboral = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/InformacionLaboral")->json();
    $informacionlaboral = collect($InformacionLaboral)->firstWhere('id_persona', $id_persona);

    // Buscar ingresos y egresos
    $ingresos = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos")->json();
    $ingreso = collect($ingresos)->firstWhere('id_persona', $id_persona);

    $referencias = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/referenciasfamiliares")->json();
    $referencia = collect($referencias)->firstWhere('id_persona', $id_persona);

    $solicitudes = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/solicitudes")->json();
    $solicitud = collect($solicitudes)->firstWhere('id_persona', $id_persona);

    $solicitudes = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/solicitudes")->json();
    $solicitud = collect($solicitudes)->firstWhere('id_persona', $id_persona);

    $solicitudes = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/relacionsolicitudpersona")->json();
    $solicitudr = collect($solicitudes)->firstWhere('id_persona', $id_persona);

    $todas_las_personas = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/personas")->json();
    $personas = collect($todas_las_personas);

    // Buscar avales por nombre
    $aval1 = $personas->firstWhere('nombres_apellidos', $relacion['nombre_aval1']);
    $aval2 = $personas->firstWhere('nombres_apellidos', $relacion['nombre_aval2']);
    $aval3 = $personas->firstWhere('nombres_apellidos', $relacion['nombre_aval3']);


    $datos = [
        'persona' => $persona,
        'conyuge' => $conyuge,
        'informacionlaboral' => $informacionlaboral,
        'vivienda' => $vivienda,
        'estado_ingresos' => $ingreso,
        'referencias_familiares' => $referencia,
        'solicitud' => $solicitud,
        'relacion' => $solicitudr,
        'avales' => collect([$aval1, $aval2, $aval3])->filter(),
    ];
    
    // Cargar PDF con los datos
    $pdf = PDF::loadView('relacion.solicitud', compact('datos'));

    $pdf->setPaper('A3', 'portrait');


    return $pdf->stream("solicitud_persona_{$id_solicitud}.pdf");
}


}




