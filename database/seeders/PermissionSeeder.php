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
            // Usuarios
            'ver_usuarios',
            'crear_usuarios',
            'editar_usuarios',
            'eliminar_usuarios',

            // Roles
            'ver_roles',
            'crear_roles',
            'editar_roles',
            'eliminar_roles',

            // Permisos
            'ver_permisos',
            'crear_permisos',
            'editar_permisos',
            'eliminar_permisos',

            // Profesores
            'ver_profesores',
            'exportar_profesores',

            // Horarios
            'ver_horarios',
            'crear_horarios',
            'editar_horarios',
            'eliminar_horarios',
            'ver_aulas_por_sede',
            'ver_unidades_curriculares_por_periodo',
            'exportar_horarios_pdf',

            // Docentes
            'ver_docentes',
            'crear_docentes',
            'editar_docentes',
            'eliminar_docentes',

            // Periodos Académicos
            'ver_periodos_academicos',
            'crear_periodos_academicos',
            'editar_periodos_academicos',
            'eliminar_periodos_academicos',

            // Unidad Curricular
            'ver_unidades_curriculares',
            'crear_unidades_curriculares',
            'editar_unidades_curriculares',
            'eliminar_unidades_curriculares',

            // Unidad Curricular Periodo Académico
            'ver_unidad_curricular_periodo_academico',
            'crear_unidad_curricular_periodo_academico',
            'editar_unidad_curricular_periodo_academico',
            'eliminar_unidad_curricular_periodo_academico',

            // Lineamiento Docente
            'ver_lineamientos_docente',
            'crear_lineamientos_docente',
            'editar_lineamientos_docente',
            'eliminar_lineamientos_docente',

            // Desempeño Docente
            'ver_desempeno_docente',
            'crear_desempeno_docente',
            'editar_desempeno_docente',
            'eliminar_desempeno_docente',

            // Curso Intersemestral
            'ver_curso_inter_semestral',
            'crear_curso_inter_semestral',
            'editar_curso_inter_semestral',
            'eliminar_curso_inter_semestral',

            // Plan Evaluación Docente
            'ver_plan_evaluacion_docente',
            'crear_plan_evaluacion_docente',
            'editar_plan_evaluacion_docente',
            'eliminar_plan_evaluacion_docente',

            // Temario Docente
            'ver_temario_docente',
            'crear_temario_docente',
            'editar_temario_docente',
            'eliminar_temario_docente',

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

            // Talento Humano
            'ver_talento_humano',
            'crear_talento_humano',
            'editar_talento_humano',
            'eliminar_talento_humano',

            // Incidente Estudiantil
            'ver_incidente_estudiantil',
            'crear_incidente_estudiantil',
            'editar_incidente_estudiantil',
            'eliminar_incidente_estudiantil',

            // Servicio Comunitario
            'ver_servicio_comunitario',
            'crear_servicio_comunitario',
            'editar_servicio_comunitario',
            'eliminar_servicio_comunitario',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
