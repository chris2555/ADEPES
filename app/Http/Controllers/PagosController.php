<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Pago;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Persona;


class PagosController extends Controller
{
    
    public function index()
    {
        $ModelResponse = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/pagoss");
        $pagos = $ModelResponse->json();
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/Prestamo');
        $prestamos = $response->json(); 
        $personas = Persona::where('tipo_persona', 'Solicitante')->get(); 
        return view('pagos.pagos', compact('pagos', 'personas', 'prestamos'));
        
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pagos.pagos');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'id_prestamo' => 'required',
        'id_persona' => 'required',
        'monto' => 'required|numeric|min:0',
        'metodo_pago' => 'required|in:Efectivo,Transferencia,Cheque',
        'recibo' => 'required|unique:pagos,recibo',
        'fecha' => 'required|date',
        'intereses' => 'nullable|numeric|min:0',
    ]);

    Pago::create([
        'id_prestamo' => $request->id_prestamo,
        'id_persona' => $request->id_persona,
        'monto' => $request->monto,
        'metodo_pago' => $request->metodo_pago,
        'recibo' => $request->recibo,
        'fecha' => $request->fecha,
        'intereses' => $request->intereses ?? 0,
        'creado_por' => auth()->id(), // Aquí se asigna automáticamente
    ]);

    return redirect()->back()->with('success', 'Pago registrado correctamente.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Buscar el recurso por su ID
        $pago = Pago::find($id);
    
        // Mostrar la vista con los detalles del recurso
        return view('pagos.edit', compact('pago'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_prestamo' => 'required',
            'id_persona' => 'required',
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|in:Efectivo,Transferencia,Cheque',
            'recibo' => 'required',
            'fecha' => 'required|date',
            'intereses' => 'nullable|numeric|min:0',
        ]);
    
        // Encontrar el pago que se va a actualizar
        $pago = Pago::findOrFail($id);
    
        // Actualizar los campos del pago
        $pago->update([
            'id_prestamo' => $request->id_prestamo,
            'id_persona' => $request->id_persona,
            'monto' => $request->monto,
            'metodo_pago' => $request->metodo_pago,
            'recibo' => $request->recibo,
            'fecha' => $request->fecha,
            'intereses' => $request->intereses ?? 0,
            'actualizado_por' => auth()->id(), // Aquí se asigna el usuario que actualizó el pago
        ]);
    
        return redirect()->route('pagos.index')->with('success', 'Pago actualizado correctamente.');
    }
    
    public function destroy(string $id)
{
    // Buscar el recurso por su ID
    $pago = Pago::find($id);

    // Verificar si el recurso existe
    if (!$pago) {
        // Enviar mensaje de error y redirigir al índice
        return redirect()->route('pagos.index')->with('error', 'Pago no encontrado');
    }

    // Eliminar el recurso
    $pago->delete();

    // Enviar mensaje de éxito y redirigir al índice
    return redirect()->route('pagos.index')->with('success', 'Pago eliminado correctamente');
}


public function obtenerPagos($id_persona)
{
    $response = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/pagado/{$id_persona}");

    if ($response->successful()) {
        $pagado = $response->json();

        // Verificar si los datos son válidos
        if (empty($pagado)) {
            return redirect()->back()->with('error', 'No se encontraron datos de pagos.');
        }

        // Cargar la vista y generar el PDF
        $pdf = PDF::loadView('pagos.pagado', compact('pagado'));

        return $pdf->stream();
    } else {
        return redirect()->back()->with('error', 'No se pudo obtener los datos de pagos.');
    }
}

}
