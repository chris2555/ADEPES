<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Persona;

class InformacionLaboralController extends Controller
{
    public function index()
    {
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/InformacionLaboral');
        $InformacionLaboral = $response->json();
        $personas = Persona::all();

        return view('InformacionLaboral.index', compact('InformacionLaboral' , 'personas'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
    
        $usuario_id = auth()->id();

        $response = Http::post('https://goldfish-app-q3ucp.ondigitalocean.app/api/InformacionLaboral', [
            'id_persona' => $request->id_persona,
            'profesion_oficio' => $request->profesion_oficio,
            'actividad' => $request->actividad,
            'patrono_negocio' => $request->patrono_negocio,
            'tiempo_laborar' => $request->tiempo_laborar,
            'ingresos_negocio' => $request->ingresos_negocio,
            'direccion_trabajo' => $request->direccion_trabajo,
            'gastos_alimentacion' => $request->gastos_alimentacion,
            'creado_por' => $request->creado_por,
            'creado_en' => $request->creado_en,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $idCreado = $data['id_informacion_laboral'] ?? 'desconocido';
        
            $persona = Persona::find($request->id_persona);
            $nombrePersona = $persona ? $persona->nombres_apellidos : 'registro';
        
            $request->merge([
                '_id_creado_api' => $idCreado,
                '_nombre_creado_api' => $nombrePersona,
            ]);
            return redirect()->route('informacionlaboral.index')->with('success', 'Datos laborales creados correctamente.');
        }

        return redirect()->route('informacionlaboral.index')->with('error', 'Ocurrió un error al crear los datos laborales.');
    }

    public function show(string $id)
    {
        $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/InformacionLaboral/{$id}");
            $informacionlaboral = $response->json();
            $personas = Persona::all();

            return view('informacionlaboral.edit', compact('informacionlaboral' , 'personas'));
        }

       
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
{
    $response = Http::put("https://goldfish-app-q3ucp.ondigitalocean.app/api/InformacionLaboral/{$id}", [
        'id_persona' => $request->id_persona,
        'profesion_oficio' => $request->profesion_oficio,
        'actividad' => $request->actividad,
        'patrono_negocio' => $request->patrono_negocio,
        'tiempo_laborar' => $request->tiempo_laborar,
        'ingresos_negocio' => $request->ingresos_negocio,
        'direccion_trabajo' => $request->direccion_trabajo,
        'gastos_alimentacion' => $request->gastos_alimentacion,
        'modificado_por' => $request->modificado_por,
        'modificado_en' => $request->modificado_en,
    ]);

    // ⚠️ Imprimir respuesta para depuración
    if (!$response->successful()) {
        dd($response->json()); // Muestra el error real antes de redirigir
    }

    return redirect()->route('informacionlaboral.index')->with('success', 'Información laboral actualizada correctamente.');
}

    public function destroy(string $id)
    {
        $response = Http::delete("https://goldfish-app-q3ucp.ondigitalocean.app/api/InformacionLaboral/{$id}");

        if ($response->successful()) {
            return redirect()->route('informacionlaboral.index')->with('success', 'Información laboral eliminada correctamente.');
        }

        return redirect()->route('informacionlaboral.index')->with('error', 'Ocurrió un error al eliminar la información laboral.');
    }
}
