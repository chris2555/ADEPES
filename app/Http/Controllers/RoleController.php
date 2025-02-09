<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all(); 
        return view('Roles.verroles', compact('roles')); 
        
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
        // 1. Validar los datos del formulario
        $request->validate([
            'name' => 'required|unique:roles,name', // 'name' es requerido y único en la tabla 'roles', columna 'name'
            'guard_name' => 'required|in:web,api', // 'guard_name' es requerido y debe ser 'web' o 'api'
        ], [
            'name.required' => 'El nombre del rol es obligatorio.',
            'name.unique' => 'Ya existe un rol con ese nombre.',
            'guard_name.required' => 'El guard name es obligatorio.',
            'guard_name.in' => 'El guard name debe ser "web" o "api".',
        ]);

        // 2. Crear el nuevo rol usando el modelo Role de laravel-permission
        Role::create([
            'name' => $request->input('name'),
            'guard_name' => $request->input('guard_name'),
        ]);

        // 3. Redirigir a la vista de lista de roles con un mensaje de éxito
        return redirect()->route('verroles.index')->with('success', 'Rol creado exitosamente.');
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
        $role = Role::findOrFail($id);
        $permissions = Permission::all(); // **LÍNEA IMPORTANTE: Obtiene todos los permisos**
        return view('roles.editrole', compact('role', 'permissions')); // **LÍNEA IMPORTANTE: Pasa $permissions a la vista**
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id); // Encuentra el rol por ID o aborta con 404

        $permissions = $request->input('permissions', []); // Obtener los permisos seleccionados del request, array vacío si no hay ninguno

        $role->permissions()->sync($permissions); // Sincronizar los permisos del rol usando el método sync() de laravel-permission

        return redirect()->route('verroles.index', $role->id)->with('success', 'Permisos del rol actualizados exitosamente.'); // Redirigir de vuelta a la vista de edición del rol con mensaje de éxito
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id); // Encuentra el rol por ID o aborta con 404

        $role->delete(); // Elimina el rol de la base de datos

        return redirect()->route('verroles.index')->with('success', 'Rol eliminado exitosamente.'); // Redirige a la lista de roles con mensaje de éxito
    }
}
