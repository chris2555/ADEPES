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

    // Obtener el rol admin
    $adminRole = Role::firstOrCreate(['name' => 'admin']);

    // Asignar el permiso al rol admin
    $adminRole->givePermissionTo($permission);
    }
}
