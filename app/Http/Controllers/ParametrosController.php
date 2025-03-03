<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ParametrosController extends Controller
{
    public function index()
    {
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/Parametros');

        $parametros = $response->json();
        return view('parametro.index', compact('parametros'));
    }

    public function store(Request $request)
    {
        // Aquí va la lógica para almacenar parámetros
    }

    public function update(Request $request, string $id)
    {
        // Aquí va la lógica para actualizar parámetros
    }

    public function destroy(string $id)
    {
        // Aquí va la lógica para eliminar parámetros
    }
}
