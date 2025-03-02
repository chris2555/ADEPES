<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ParametrosController extends Controller

{


    /**
     * Display a listing of the resource.  ya estaba
     */
   public function index()
    {
        $response = Http::get('https://goldfish-app-q3ucp.ondigitalocean.app/api/Parametros', [
        ]);
            $parametros = $response->json();
            return view('parametro.index', compact('parametros'));
    }

    /**
     * Show the form for creating a new resource.   ya estaba
     */
   public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.   ya estaba
     */
   public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.  ya estaba
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.  ya estaba
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.    ya estaba
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.   ya estaba
     */
   public function destroy(string $id)
    {
        //
    }

}