<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InformacionLaboralController extends Controller
{
    public function index()
    {
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/InformacionLaboral');
        $InformacionLaboral = $response->successful() ? $response->json() : [];

        return view('informacionlaboral.index', compact('InformacionLaboral'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // ✅ Validación
        $request->validate([
            'id_persona' => 'required|numeric',
            'profesion_oficio' => 'required|string|max:100',
            'actividad' => 'required|string|max:255',
            'patrono_negocio' => 'required|string|max:100',
            'tiempo_laborar' => 'required|string|max:50',
            'estado_credito' => 'required|string|in:Aprobado,Pendiente,Rechazado',
            'valor_cuota' => 'required|numeric|min:0',
            'ingresos_negocio' => 'nullable|numeric|min:0',
            'direccion_trabajo' => 'nullable|string',
            'gastos_alimentacion' => 'nullable|numeric|min:0',
            'creado_por' => 'nullable|integer',
            'creado_en' => 'nullable|date',
        ]);

        $response = Http::post('http://127.0.0.1:3000/api/InformacionLaboral', [
            'id_persona' => $request->id_persona,
            'profesion_oficio' => $request->profesion_oficio,
            'actividad' => $request->actividad,
            'patrono_negocio' => $request->patrono_negocio,
            'tiempo_laborar' => $request->tiempo_laborar,
            'estado_credito' => $request->estado_credito,
            'valor_cuota' => $request->valor_cuota,
            'ingresos_negocio' => $request->ingresos_negocio,
            'direccion_trabajo' => $request->direccion_trabajo,
            'gastos_alimentacion' => $request->gastos_alimentacion,
            'creado_por' => $request->creado_por,
            'creado_en' => $request->creado_en,
        ]);

        if ($response->successful()) {
            return redirect()->route('informacionlaboral.index')->with('success', 'Datos laborales creados correctamente.');
        }

        return redirect()->route('informacionlaboral.index')->with('error', 'Ocurrió un error al crear los datos laborales.');
    }

    public function show(string $id)
    {
        $response = Http::get("http://127.0.0.1:3000/api/InformacionLaboral/{$id}");

        if ($response->successful()) {
            $informacionlaboral = $response->json();
            return view('informacionlaboral.edit', compact('informacionlaboral'));
        }

        return redirect()->route('informacionlaboral.index')->with('error', 'No se pudo obtener la información laboral.');
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_persona' => 'required|numeric',
            'profesion_oficio' => 'required|string|max:100',
            'actividad' => 'required|string|max:255',
            'patrono_negocio' => 'required|string|max:100',
            'tiempo_laborar' => 'required|string|max:50',
            'estado_credito' => 'required|string|in:Aprobado,Pendiente,Rechazado',
            'valor_cuota' => 'required|numeric|min:0',
            'ingresos_negocio' => 'nullable|numeric|min:0',
            'direccion_trabajo' => 'nullable|string',
            'gastos_alimentacion' => 'nullable|numeric|min:0',
            'modificado_por' => 'nullable|integer',
            'modificado_en' => 'nullable|date',
        ]);

        $response = Http::put("http://127.0.0.1:3000/api/InformacionLaboral/{$id}", [
            'id_persona' => $request->id_persona,
            'profesion_oficio' => $request->profesion_oficio,
            'actividad' => $request->actividad,
            'patrono_negocio' => $request->patrono_negocio,
            'tiempo_laborar' => $request->tiempo_laborar,
            'estado_credito' => $request->estado_credito,
            'valor_cuota' => $request->valor_cuota,
            'ingresos_negocio' => $request->ingresos_negocio,
            'direccion_trabajo' => $request->direccion_trabajo,
            'gastos_alimentacion' => $request->gastos_alimentacion,
            'modificado_por' => $request->modificado_por,
            'modificado_en' => $request->modificado_en,
        ]);

        if ($response->successful()) {
            return redirect()->route('informacionlaboral.index')->with('success', 'Información laboral actualizada correctamente.');
        }

        return redirect()->route('informacionlaboral.index')->with('error', 'Ocurrió un error al actualizar la información laboral.');
    }

    public function destroy(string $id)
    {
        $response = Http::delete("http://127.0.0.1:3000/api/InformacionLaboral/{$id}");

        if ($response->successful()) {
            return redirect()->route('informacionlaboral.index')->with('success', 'Información laboral eliminada correctamente.');
        }

        return redirect()->route('informacionlaboral.index')->with('error', 'Ocurrió un error al eliminar la información laboral.');
    }
}
