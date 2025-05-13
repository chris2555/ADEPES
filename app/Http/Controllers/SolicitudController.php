<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; // Asegúrate que esté al inicio del archivo
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
            $personas = Persona::where('tipo_persona', 'Solicitante')->get();
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
            'id_persona' => $request->id_persona,
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
            'capital' => $request->capital,
            'interes' => $request->interes,
            'es_aval' => $request->es_aval,
            'finalidad_cre' => $request->finalidad_cre,
            'creado_por' => $usuario_id,
        ]);
    

        if ($response->successful()) {
            // 1️⃣ Extraer el ID desde la respuesta de la API
            $data = $response->json();
            $idCreado = $data['id_solicitud' ] ?? 'desconocido';
        
            // 2️⃣ Inyectar el ID al request para que lo use el middleware
            $persona = Persona::find($request->id_persona);
            $nombrePersona = $persona ? $persona->nombres_apellidos : 'registro';
        
            $request->merge([
                '_id_creado_api' => $idCreado,
                '_nombre_creado_api' => $nombrePersona,
            ]);
            return redirect()->back()->with('success', 'Solicitud creada correctamente.');
        } else {
            $errorMessage = $response->json()['error'] ?? 'Error desconocido al enviar los datos a la API.';
            return redirect()->back()->with('error', "Error: $errorMessage");
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
            'id_persona' => $request->id_persona,
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
            'capital' => $request->capital,
            'interes' => $request->interes,
            'es_aval' => $request->es_aval,
            'finalidad_cre' => $request->finalidad_cre,
            'modificado_por' => $usuario_id,
        ]);

         if ($response->successful()) {
            return redirect()->route('solicitudes.index')->with('success', 'solicitud actualizada correctamente.');
        } else {
            dd($response->status(), $response->body());
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
            return redirect()->route('solicitudes.index')->with('error', 'No se puede eliminar una solicitud aprobada.');
        }
    }


    public function generarDictamen($id_solicitud)
{
    // Obtener el dictamen desde la API
    $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/dictamen/{$id_solicitud}");

    if ($response->failed()) {
        abort(404, 'No se encontró el dictamen');
    }

    $dictamen = $response->json();

    // Verificar que id_persona esté presente
    if (!isset($dictamen['id_persona'])) {
        abort(500, 'El dictamen no contiene id_persona');
    }

    $id_persona = $dictamen['id_persona'];

    // Obtener estado de ingresos de la API
    $ingresos = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos")->json();
    $ingreso = collect($ingresos)->firstWhere('id_persona', $id_persona);

    $InformacionLaboral = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/InformacionLaboral")->json();
    $informacionlaboral = collect($InformacionLaboral)->firstWhere('id_persona', $id_persona);


    $persona = Persona::find($id_persona);

    $nombreCompleto = $persona 
        ? trim("{$persona->nombre1} {$persona->nombre2} {$persona->apellido1} {$persona->apellido2}") 
        : null;
    
    $cantidadPrestamos = 0;
    
    if ($nombreCompleto) {
        $cantidadPrestamos = DB::table('persona as p')
            ->join('prestamo as pr', 'pr.id_persona', '=', 'p.id_persona')
            ->where(DB::raw("CONCAT_WS(' ', p.nombre1, p.nombre2, p.apellido1, p.apellido2)"), '=', $nombreCompleto)
            ->count();
    }
    
    $usuarioNombre = auth()->user()->name;

    $datos = [
        'dictamen' => $dictamen,
        'estado_ingresos' => $ingreso,
        'informacionlaboral' => $informacionlaboral,
        'cantidadPrestamos' => $cantidadPrestamos,
        'usuarioNombre' => $usuarioNombre,
    ];

    // Generar el PDF con la vista Blade
    $pdf = PDF::loadView('relacion.dictamen', $datos);
     $pdf->setPaper('letter', 'portrait'); // Cambiar A3 a 'letter'

    return $pdf->stream();
}


public function obtenerTablaAmortizacion($id_solicitud)
{
    // Obtener la tabla de amortización
    $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/amortizacion/{$id_solicitud}");

    if ($response->successful()) {
        $amortizacion = $response->json();

        if (empty($amortizacion)) {
            return redirect()->back()->with('error', 'No se encontraron datos para la tabla de amortización.');
        }

        // Tomar el id_persona desde la primera fila del resultado
        $id_persona = $amortizacion[0]['IdPersona'] ?? null;

        if (!$id_persona) {
            return redirect()->back()->with('error', 'No se pudo determinar el ID de la persona.');
        }

        // Obtener todas las solicitudes desde la API
        $solicitudes = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/solicitudes")->json();

        // Buscar la solicitud que coincide con el id_persona
        $solicitud = collect($solicitudes)->firstWhere('id_persona', $id_persona);

        if (!$solicitud) {
            return redirect()->back()->with('error', 'No se encontró la solicitud correspondiente.');
        }

        // Pasar los datos a la vista PDF
        $pdf = PDF::loadView('relacion.amortizacion', [
            'amortizacion' => $amortizacion,
            'solicitud' => $solicitud
        ]);

        $pdf->setPaper('letter', 'portrait');

        return $pdf->stream();

    } else {
        return redirect()->back()->with('error', 'No se pudo obtener la tabla de amortización.');
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
