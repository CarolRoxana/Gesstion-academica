<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Admin']);
      

        Role::create(['name' => 'Coordinador']);



        $admin->syncPermissions(Permission::all());
        //CREANDO ROL DE JEFE DEPARTAMENTO Y ASIGNADO ROLES
        $jefeDepartamento = Role::create(['name' => 'Jefe departamento']);
        $permisosJefeDepartamento = [
            'crear_curso_inter_semestral',
            'editar_curso_inter_semestral',
            'eliminar_curso_inter_semestral',
            'ver_curso_inter_semestral',
            'ver_talento_humano',
            'crear_talento_humano',
            'editar_talento_humano',
            'eliminar_talento_humano',
        ];
        $jefeDepartamento->syncPermissions($permisosJefeDepartamento);

        //CREANDO ROL DE JEFE DE AREA Y ASIGNADO ROLES
        $jefeArea = Role::create(['name' => 'Jefe area']);
        $permisosJefeArea = [
            'ver_talento_humano',
            'crear_talento_humano',
            'editar_talento_humano',
            'eliminar_talento_humano',
            'ver_docentes',
            'crear_docentes',
            'editar_docentes',
            'eliminar_docentes',
            'ver_desempeno_docente',
            'crear_desempeno_docente',
            'editar_desempeno_docente',
            'eliminar_desempeno_docente',
        ];
        $jefeArea->syncPermissions($permisosJefeArea);


        $secretaria = Role::create(['name' => 'Secretaria']);
        $permisosSecretaria = [
            //docentes
            'ver_docentes',
            'crear_docentes',
            'editar_docentes',
            // Propuesta TG
            'ver_propuestas_tg',
            'crear_propuestas_tg',
            'editar_propuestas_tg',
            'eliminar_propuestas_tg',
            'exportar_propuestas_grado_pdf',

            // Propuesta TP
            'ver_propuestas_tp',
            'crear_propuestas_tp',
            'editar_propuestas_tp',
            'eliminar_propuestas_tp',
            'exportar_propuestas_pasantia_pdf',
            // Servicio Comunitario
            'ver_servicio_comunitario',
            'crear_servicio_comunitario',
            'editar_servicio_comunitario',
            'eliminar_servicio_comunitario',

            //HORARIOS 
            //'ver_horarios',
            'exportar_horarios_pdf',

            // Profesores
            'ver_profesores',
            'exportar_profesores',
        ];

        $secretaria->syncPermissions($permisosSecretaria);


          $docente = Role::create(['name' => 'Docente']);
          

        // Asignar permisos al rol de Docente
        $permisosDocente = [
            'ver_docentes',
            'crear_docentes',
            'editar_docentes',
            'eliminar_docentes',

            // Temario Docente
            'ver_temario_docente',
            'crear_temario_docente',
            'editar_temario_docente',
            'eliminar_temario_docente',

            //Plan Evaluación Docente
            'ver_plan_evaluacion_docente',
            'crear_plan_evaluacion_docente',
            'editar_plan_evaluacion_docente',
            'eliminar_plan_evaluacion_docente',

            // Propuesta TG
            'ver_propuestas_tg',
            'crear_propuestas_tg',
            'editar_propuestas_tg',
            'eliminar_propuestas_tg',
            'exportar_propuestas_grado_pdf',

            // Propuesta TP
            'ver_propuestas_tp',
            'crear_propuestas_tp',
            'editar_propuestas_tp',
            'eliminar_propuestas_tp',
            'exportar_propuestas_pasantia_pdf',

            // Servicio Comunitario
            'ver_servicio_comunitario',
            'crear_servicio_comunitario',
            'editar_servicio_comunitario',
            'eliminar_servicio_comunitario',

        ];
        $docente->syncPermissions($permisosDocente);
    }
}
