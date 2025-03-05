<?php

namespace App\Http\Controllers\Api;

use App\Models\Parametro;
use Illuminate\Http\Request;
use App\Http\Requests\ParametroRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ParametroResource;

class ParametroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $parametros = Parametro::paginate();

        return ParametroResource::collection($parametros);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParametroRequest $request): JsonResponse
    {
        $parametro = Parametro::create($request->validated());

        return response()->json(new ParametroResource($parametro));
    }

    /**
     * Display the specified resource.
     */
    public function show(Parametro $parametro): JsonResponse
    {
        return response()->json(new ParametroResource($parametro));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParametroRequest $request, Parametro $parametro): JsonResponse
    {
        $parametro->update($request->validated());

        return response()->json(new ParametroResource($parametro));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Parametro $parametro): Response
    {
        $parametro->delete();

        return response()->noContent();
    }
}
