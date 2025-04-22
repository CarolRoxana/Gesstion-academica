<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DocenteRoleSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'Docente']);

        $permission = Permission::firstOrCreate(['name' => 'view_horarios']);

        $role->givePermissionTo($permission);
    }
}
