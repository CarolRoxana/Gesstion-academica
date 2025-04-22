<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view_docentes', 'create_docentes', 'edit_docentes', 'delete_docentes',
            'view_propuestas_tg', 'create_propuestas_tg', 'edit_propuestas_tg', 'delete_propuestas_tg',
            'view_propuestas_tp', 'create_propuestas_tp', 'edit_propuestas_tp', 'delete_propuestas_tp',
            'view_evaluaciones', 'create_evaluaciones', 'edit_evaluaciones', 'delete_evaluaciones',
            'view_lineamientos_docente', 'create_lineamientos_docente', 'edit_lineamientos_docente', 'delete_lineamientos_docente',
            'view_periodos_academicos', 'create_periodos_academicos', 'edit_periodos_academicos', 'delete_periodos_academicos',
            'view_unidad_curricular_periodo_academico', 'create_unidad_curricular_periodo_academico', 'edit_unidad_curricular_periodo_academico', 'delete_unidad_curricular_periodo_academico',
            'view_roles', 'create_roles', 'edit_roles', 'delete_roles',
            'view_usuarios', 'create_usuarios', 'edit_usuarios', 'delete_usuarios',
            'view_permisos', 'create_permisos', 'edit_permisos', 'delete_permisos',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

    }
}
