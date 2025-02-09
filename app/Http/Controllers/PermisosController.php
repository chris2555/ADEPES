<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('Permisos.permisos', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // 1. Validar los datos del formulario
        $request->validate([
            'name' => 'required|unique:permissions,name', // 'name' es requerido y único en la tabla 'permissions', columna 'name'
            'guard_name' => 'required|in:web,api', // 'guard_name' es requerido y debe ser 'web' o 'api'
        ], [
            'name.required' => 'El nombre del permiso es obligatorio.',
            'name.unique' => 'Ya existe un permiso con ese nombre.',
            'guard_name.required' => 'El guard name es obligatorio.',
            'guard_name.in' => 'El guard name debe ser "web" o "api".',
        ]);

        // 2. Crear el nuevo permiso usando el modelo Permission de laravel-permission
        Permission::create([
            'name' => $request->input('name'),
            'guard_name' => $request->input('guard_name'),
        ]);

        // 3. Redirigir a la vista de lista de permisos con un mensaje de éxito
        return redirect()->route('permisos.index')->with('success', 'Permiso creado exitosamente.');
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
        $permission = Permission::findOrFail($id);
        return view('permisos.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Encontrar el permiso a editar
        $permission = Permission::findOrFail($id);

        // 2. Validar los datos del formulario
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id, // 'unique' ignora el permiso actual por ID
            'guard_name' => 'required|in:web,api',
        ], [
            'name.required' => 'El nombre del permiso es obligatorio.',
            'name.unique' => 'Ya existe un permiso con ese nombre.',
            'guard_name.required' => 'El guard name es obligatorio.',
            'guard_name.in' => 'El guard name debe ser "web" o "api".',
        ]);

        // 3. Actualizar el permiso con los datos validados
        $permission->update([
            'name' => $request->input('name'),
            'guard_name' => $request->input('guard_name'),
        ]);

        // 4. Redirigir a la vista de lista de permisos con mensaje de éxito
        return redirect()->route('permisos.index')->with('success', 'Permiso actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id); 

        $permission->delete(); 

    return redirect()->route('permisos.index')->with('success', 'Permiso eliminado exitosamente.'); 
    }
}
