<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Docente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UnidadCurricularSeeder extends Seeder
{
    public function run(): void
    {
        $docentes = Docente::all();

        DB::table('unidad_curricular')->insert([
            [
                'docente_id' => $docentes->random()->id,
                'nombre' => 'MATEMATICA III',
                'unidad_curricular' => '4',
                'carrera' => 'Ingeniería de Informática',
                'semestre' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'docente_id' => $docentes->random()->id,
                'nombre' => 'PROGRAMACION I',
                'unidad_curricular' => '4',
                'carrera' => 'Ingeniería de Informática',
                'semestre' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'docente_id' => $docentes->random()->id,
                'nombre' => 'INTRODUCCION A LA INFORMATICA',
                'unidad_curricular' => '4',
                'carrera' => 'Ingeniería de Informática',
                'semestre' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'docente_id' => $docentes->random()->id,
                'nombre' => 'SISTEMAS DE BASE DE DATOS II',
                'unidad_curricular' => '4',
                'carrera' => 'Ingeniería de Informática',
                'semestre' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'docente_id' => $docentes->random()->id,
                'nombre' => 'ESTRUCTURA DE DATOS',
                'unidad_curricular' => '4',
                'carrera' => 'Ingeniería de Informática',
                'semestre' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'docente_id' => $docentes->random()->id,
                'nombre' => 'SEMINARIO DE TRABAJO DE GRADO',
                'unidad_curricular' => '4',
                'carrera' => 'Ingeniería de Informática',
                'semestre' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'docente_id' => $docentes->random()->id,
                'nombre' => 'ROBOTICA',
                'unidad_curricular' => '4',
                'carrera' => 'Ingeniería de Informática',
                'semestre' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
