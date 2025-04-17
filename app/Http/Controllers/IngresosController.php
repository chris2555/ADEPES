<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Persona;

class IngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos', []);
        
        //$solicitudes = SolicitudPrestamo::all();
        $personas = Persona::all();
        $ingresos = $response->json();
        
       
        return view('ingresos.index', compact('ingresos', 'personas'));

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
        
        $total_ingresos = $request->sueldo_base + $request->renta_propiedades + $request->remesas + $request->aporte_conyuge + $request->ingresos_sociedad;
        $total_egresos = $request->cuota_de_prestamo + $request->cuota_vivienda + $request->alimentacion + $request->central_riesgo + $request->otro_egresos;
        $ingreso_neto = $total_ingresos - $total_egresos;

        // Enviar la solicitud HTTP con los datos
        $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos', [
            //'id_solicitud' => $request->id_solicitud,
            'id_persona' => $request->id_persona,
            'nombres_persona' => $request->nombres_persona,
            'sueldo_base' => $request->sueldo_base,
            'renta_propiedades' => $request->renta_propiedades,
            'remesas' => $request->remesas,
            'aporte_conyuge' => $request->aporte_conyuge,
            'ingresos_sociedad' => $request->ingresos_sociedad,
            'total_ingresos' => $request->sueldo_base + $request->renta_propiedades + $request->remesas + $request->aporte_conyuge + $request->ingresos_sociedad,
            'cuota_de_prestamo' => $request->cuota_de_prestamo,
            'cuota_vivienda' => $request->cuota_vivienda,
            'alimentacion' => $request->alimentacion,
            'central_riesgo' => $request->central_riesgo,
            'otro_egresos' => $request->otro_egresos,
            'total_egresos' =>  $request->cuota_de_prestamo + $request->cuota_vivienda + $request->alimentacion + $request->central_riesgo + $request->otro_egresos,
            'ingreso_neto' => $total_ingresos - $total_egresos,
            'creado_por' => auth()->id(), // Agregar el ID del usuario autenticado
            'creado_por_nombre' => $request->creado_por_nombre
        ]);
        

        if ($response->successful()) {
            // 1️⃣ Extraer el ID desde la respuesta de la API
            $data = $response->json();
            $idCreado = $data['id_ingresos' ] ?? 'desconocido';
        
            // 2️⃣ Inyectar el ID al request para que lo use el middleware
            $persona = Persona::find($request->id_persona);
            $nombrePersona = $persona ? $persona->nombres_apellidos : 'registro';
        
            $request->merge([
                '_id_creado_api' => $idCreado,
                '_nombre_creado_api' => $nombrePersona,
            ]);
            
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
        $personas = Persona::all();
        return view('ingresos.edit', compact('ingresos', 'personas'));
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
        
        $total_ingresos = $request->sueldo_base + $request->renta_propiedades + $request->remesas + $request->aporte_conyuge + $request->ingresos_sociedad;
        $total_egresos = $request->cuota_de_prestamo + $request->cuota_vivienda + $request->alimentacion + $request->central_riesgo + $request->otro_egresos;
        $ingreso_neto = $total_ingresos - $total_egresos;

        
        $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/estadoingresos/{$id}", [
            //'id_solicitud' => $request->id_solicitud,
            'id_persona' => $request->id_persona,
            'nombres_persona' => $request->nombres_persona,
            'sueldo_base' => $request->sueldo_base,
            'renta_propiedades' => $request->renta_propiedades,
            'remesas' => $request->remesas,
            'aporte_conyuge' => $request->aporte_conyuge,
            'ingresos_sociedad' => $request->ingresos_sociedad,
            'total_ingresos' => $request->sueldo_base + $request->renta_propiedades + $request->remesas + $request->aporte_conyuge + $request->ingresos_sociedad,
            'cuota_de_prestamo' => $request->cuota_de_prestamo,
            'cuota_vivienda' => $request->cuota_vivienda,
            'alimentacion' => $request->alimentacion,
            'central_riesgo' => $request->central_riesgo,
            'otro_egresos' => $request->otro_egresos,
            'total_egresos' =>  $request->cuota_de_prestamo + $request->cuota_vivienda + $request->alimentacion + $request->central_riesgo + $request->otro_egresos,
            'ingreso_neto' => $total_ingresos - $total_egresos,
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
