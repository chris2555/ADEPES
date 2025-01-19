<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear el permiso
        $permission = Permission::firstOrCreate(['name' => 'users.index']);
    
        // Crear el rol admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
    
        // Asignar el permiso al rol admin
        $adminRole->givePermissionTo($permission);
    
        // Obtener el usuario con id 3
        $user = User::find(3);
    
        if ($user) {
            // Asignar el rol al usuario
            $user->assignRole($adminRole);
        }
    }
    
}
