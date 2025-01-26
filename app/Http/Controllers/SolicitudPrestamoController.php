<?php

namespace App\Http\Controllers;
use App\Models\SolicitudPrestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudPrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('prestamo.index');
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
         // Validar los datos del formulario
    $validated = $request->validate([
        'tipo_garantia' => 'required|in:Fiduciaria,Prendaria,Hipotecaria,Solidaria',
        'tipo_cuota' => 'required|in:Nivelada,Variable',
        'tasa' => 'required|numeric|min:0|max:100',
        'plazo' => 'required|integer|min:1',
        'monto' => 'required|numeric|min:0',
        'invierte_en' => 'required|in:Comercio,Industria,Servicios,Agropecuario',
        'tipo_credito' => 'required|in:Reingreso,Refinanciamiento,Novacion,Primera Vez',
        'estado_solicitud' => 'required|in:Pendiente,Aprobado,Rechazado',
        'valor_cuota' => 'required|numeric|min:0',
        'es_aval' => 'required|in:No es aval,Avala 1 persona,Avala 2 personas,Avala más de 2 personas',
    ]);

    // Crear una nueva solicitud de préstamo
    $solicitud = SolicitudPrestamo::create([
        'tipo_garantia' => $validated['tipo_garantia'],
        'tipo_cuota' => $validated['tipo_cuota'],
        'tasa' => $validated['tasa'],
        'plazo' => $validated['plazo'],
        'monto' => $validated['monto'],
        'invierte_en' => $validated['invierte_en'],
        'tipo_credito' => $validated['tipo_credito'],
        'estado_solicitud' => $validated['estado_solicitud'],
        'valor_cuota' => $validated['valor_cuota'],
        'es_aval' => $validated['es_aval'],
        'creado_por' => auth()->id(), // Usuario autenticado
    ]);
    return redirect()->route('solicitud.index')->with('success', 'Solicitud creada con éxito.');
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
        //
    }
}
