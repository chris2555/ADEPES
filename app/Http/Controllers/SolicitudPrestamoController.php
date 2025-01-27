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
    return view('prestamo.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)


    /**
     * Display the specified resource.
     */


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
