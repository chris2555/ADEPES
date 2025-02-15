<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagosController extends Controller
{
    
    public function index()
    {
        $ModelResponse = Http::get("https://goldfish-app-q3ucp.ondigitalocean.app/pagos");
        
        $ModelDataToJson = $ModelResponse->json() ?? [];

        //info de la tabla
        $heads = [
            "id_pago" => "ID",
            "id_prestamo" => "Id Prestamo",
            "id_persona" => "Id Persona",
            "metodo_pago" => "Metodo de Pago",
            "monto" => "Cantidad depositada",
            "fecha" => "Fecha que se Realizo el pago",
            "Acciones" => "Acciones"
        ];

        $dataTable = [];

        for ($i = 0; $i < count($ModelDataToJson); $i++) {
            $row = [];
            foreach ($heads as $key => $value) {
                if (!array_key_exists($key, $ModelDataToJson[$i]) && array_key_exists("Acciones", $heads)) {

                    //en los botones modificar la parte del data-id con lo que regrese la consulta
                    $btnEdit = '<button class="btn btn-xs btn-default text-blue mx-1 shadow" id="editInfo" data-toggle="modal" data-id="' . $ModelDataToJson[$i]['id_pago'] . '" data-target="#edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>';

                    $btnDelete = '<button class="btn btn-xs btn-default text-red mx-1 shadow" id="deleteInfo" data-id="' . $ModelDataToJson[$i]['id_pago'] . '" data-target="#delete">
                              <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';

                    $btnDetails = '<button type="button" class="btn btn-xs btn-default text-teal mx-1 shadow" id="showInfo" data-toggle="modal" data-id="' . $ModelDataToJson[$i]['id_pago'] . '" data-target="#view">
                <i class="fa fa-lg fa-fw fa-eye"></i>
            </button>';

                    $row[] = '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>';
                } else {
                    $row[] = $ModelDataToJson[$i][$key];
                }
            }
            $dataTable[] = $row;
        }


        $configTable = [
            'data' => $dataTable,
            'order' => [[1, 'asc']],
            'ordering' => true,
        ];


        //informacion a mandar al blade
        $information = [
            'headsTable' => array_values($heads),
            'config' => $configTable,
        ];

        return view("pagos.pagos")->with('info', $information);


    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
