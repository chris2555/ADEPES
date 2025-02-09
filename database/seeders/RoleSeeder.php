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
        Permission::create(['name' => 'ver-usuarios']);
        Permission::create(['name' => 'crear-usuarios']);
        Permission::create(['name' => 'editar-usuarios']);
        Permission::create(['name' => 'eliminar-usuarios']);
    }
    
}
