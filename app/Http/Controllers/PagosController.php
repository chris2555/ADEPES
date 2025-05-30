<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Pago;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;


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
        'id_prestamo'   => 'required|integer',
        'id_persona'    => 'required|integer',
        'monto'         => 'required|numeric|min:0',
        'metodo_pago'   => 'required|in:Efectivo,Transferencia,Cheque',
        'recibo'        => 'required|unique:pagos,recibo',
        'fecha'         => 'required|date|',
        'intereses'     => 'nullable|numeric|min:0',
        'abono_capital' => 'nullable|numeric|min:0'
    ]);

    DB::beginTransaction(); // Inicia la transacción

    
    try {
        // Insertar el pago y obtener el ID
        $id_pago = DB::table('pagos')->insertGetId([
            'id_prestamo'   => $request->id_prestamo,
            'id_persona'    => $request->id_persona,
            'monto'         => $request->monto,
            'metodo_pago'   => $request->metodo_pago,
            'recibo'        => $request->recibo,
            'fecha'         => $request->fecha,
            'intereses'     => $request->intereses ?? 0,
            'abono_capital' => $request->abono_capital ?? 0, 
            'creado_por' => auth()->id(),
            'estado'        => 'pendiente',
            'creado_en'     => now(),
        ]);

    
        // Llamar al procedimiento almacenado
        DB::statement("CALL verificar_pago(?, ?);", [$id_pago, $request->id_persona]);

        //dd($request->all(), $id_pago);
        DB::commit(); // Confirma la transacción

        // Responder en función del tipo de solicitud (JSON o redirección)
        if ($request->ajax()) {
            return response()->json(['message' => 'Pago registrado correctamente', 'id_pago' => $id_pago], 201);
        }

        return redirect()->back()->with('success', 'Pago registrado correctamente.');
        
    } catch (\Exception $e) {
        DB::rollback(); // Revierte la transacción en caso de error
        return response()->json(['error' => 'Error al registrar el pago: ' . $e->getMessage()], 500);
    }
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
        'id_prestamo'   => 'required|integer',
        'id_persona'    => 'required|integer',
        'monto'         => 'required|numeric|min:0',
        'metodo_pago'   => 'required|in:Efectivo,Transferencia,Cheque',
        'recibo'        => 'required', // no se puede poner 'unique' directamente aquí
        'fecha'         => 'required|date',
        'intereses'     => 'nullable|numeric|min:0',
        'abono_capital' => 'nullable|numeric|min:0'
    ]);

    DB::beginTransaction();

    try {
        $pago = Pago::findOrFail($id);

        // Calcular abono_capital automáticamente si no viene en la request
        $abonoCapital = $request->abono_capital ?? ($request->monto - ($request->intereses ?? 0));

        $pago->update([
            'id_prestamo'     => $request->id_prestamo,
            'id_persona'      => $request->id_persona,
            'monto'           => $request->monto,
            'metodo_pago'     => $request->metodo_pago,
            'recibo'          => $request->recibo,
            'fecha'           => $request->fecha,
            'intereses'       => $request->intereses ?? 0,
            'abono_capital'   => $abonoCapital,
            'actualizado_por' => auth()->id(),
            //'actualizado_en'  => now(), // si usas esta columna
        ]);
        //dd($request->all(), $id);
        // Llamada al procedimiento almacenado equivalente al de store
        DB::statement('CALL verificar_pago(?, ?)', [$id, $request->id_persona]);

        DB::commit();

        return redirect()->route('pagos.index')->with('success', 'Pago actualizado correctamente.');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'Error al actualizar el pago: ' . $e->getMessage());
    }
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


public function obtenerRecibos($id_persona, $id_pago)
{
    $recibo = DB::table('pagos')
        ->where('id_pago', $id_pago)
        ->where('id_persona', $id_persona)
        ->first();

    if (!$recibo) {
        abort(404, 'Recibo no encontrado');
    }

    $recibo = (array) $recibo;

    $usuarioNombre = auth()->user()->name;

    $solicitudesResponse = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/solicitudes");
    $solicitud = null;
    if ($solicitudesResponse->ok()) {
        $solicitud = collect($solicitudesResponse->json())->firstWhere('id_persona', $id_persona);
    }

    $personasResponse = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/api/personas");
    $persona = null;
    if ($personasResponse->ok()) {
        $persona = collect($personasResponse->json())->firstWhere('id_persona', $id_persona);
    }

    $datos = [
        'recibos' => [$recibo],
        'usuarioNombre' => $usuarioNombre,
        'solicitud' => $solicitud,
        'persona' => $persona,
        'primerPago' => $recibo,
        'recibo' => $recibo, // Asegúrate que también esté esta variable si la usas en la vista
    ];

    $pdf = \PDF::loadView('pagos.recibo', $datos);
    return $pdf->stream('recibo_pago.pdf');
}




}




