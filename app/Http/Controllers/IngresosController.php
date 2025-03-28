<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\SolicitudPrestamo;
use App\Models\Persona;
use App\Models\EstadoEgresos;

class IngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ModelResponse = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos");
        
        $solicitudes = SolicitudPrestamo::all();
        $personas = Persona::where('tipo_persona', 'Solicitante')->get();
        $ingresos = $ModelResponse->json(); 
        
       
        return view('ingresos.index', compact('ingresos', 'solicitudes', 'personas'));

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

        // Obtener el ID del usuario autenticado
        $usuario_id = auth()->id();
        
        // Enviar la solicitud HTTP con los datos
        $responseIngresos = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos', [
            'id_solicitud' => $request->id_solicitud,
            'id_persona' => $request->id_persona,
            'renta_propiedades' => $request->renta_propiedades,
            'remesas' => $request->remesas,
            'aporte_conyuge' => $request->aporte_conyuge,
            'ingresos_sociedad' => $request->ingresos_sociedad,
            'total_ingresos' => $request->renta_propiedades + $request->remesas + $request->aporte_conyuge + $request->ingresos_sociedad,
            'creado_por' => $usuario_id,
            'creado_por_nombre' => $request->creado_por_nombre
        ]);
        
        
        //dd($responseIngresos->json());

        // Obtener el id_solicitud generado en estadoingresos
        $id_solicitud = $responseIngresos->json()['id_solicitud'] ?? null;
        $id_persona = $responseIngresos->json()['id_persona'] ?? null;
        

        $usuario_id = auth()->id();
        $responseEgresos = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/EstadoEgresos', [
            'id_solicitud' => $id_solicitud,  // Aquí usamos el mismo id_solicitud
            'id_persona' => $id_persona,
            'cuota_de_prestamo' => $request->cuota_de_prestamo,
            'cuota_vivienda' => $request->cuota_vivienda,
            'alimentacion' => $request->alimentacion,
            'central_riesgo' => $request->central_riesgo,
            'otro_egresos' => $request->otro_egresos,
            'total_egresos' => $request->cuota_de_prestamo + $request->cuota_vivienda + $request->alimentacion + $request->central_riesgo + $request->otro_egresos, 
            'creado_por' => $usuario_id,
            'creado_por_nombre' => $request->creado_por_nombre
        ]);
        
        // se ingreso correctamente el estadoEgresos
        if (!$responseEgresos->successful()) {
            dd('Error en EstadoEgresos:', $responseEgresos->json());
        }
    
         
          if ($responseIngresos->successful()) {
            return redirect()->route('ingresos.index')->with('success', 'Estado de Ingresos creado correctamente');
          } else {
            return redirect()->route('ingresos.index')->with('error', 'Ocurrió un error al crear el Estado de Ingresos');
          }



    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos/{$id}");
        $ingresos = $response->json();
        $solicitudes = SolicitudPrestamo::all(); 
        $personas = Persona::all();
        return view('ingresos.edit', compact('ingresos', 'solicitudes', 'personas'));
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
        
        $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos/{$id}", [
            'id_solicitud' => $request->id_solicitud,
            'id_persona' => $request->id_persona,
            'renta_propiedades' => $request->renta_propiedades,
            'remesas' => $request->remesas,
            'aporte_conyuge' => $request->aporte_conyuge,
            'ingresos_sociedad' => $request->ingresos_sociedad,
            'total_ingresos' => $request->renta_propiedades + $request->remesas + $request->aporte_conyuge+ $request->ingresos_sociedad,
            'modificado_por' => $usuario_id
        ]);

        
        if ($response->successful()) {
            return redirect()->route('ingresos.index')->with('success', 'Estado de Ingresos actualizado correctamente');
        } else {
            return redirect()->route('ingresos.index')->with('error', 'Ocurrió un error al actualizar el Estado de Ingresos');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete("https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos/{$id}");
        if ($response->successful()) {
            return redirect()->route('ingresos.index')->with('success', 'Estado de Ingresos eliminado correctamente');
        } else {
            return redirect()->route('ingresos.index')->with('error', 'Ocurrió un error al eliminar el Estado de Ingresos');
        }
    }
}
