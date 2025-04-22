<?php

namespace Database\Seeders;

use App\Models\Docente;
use App\Models\PeriodoAcademico;
use App\Models\UnidadCurricular;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UnidadCurricularPeriodoAcademicoSeeder extends Seeder
{
    public function run(): void
    {
        $unidadCurricular = UnidadCurricular::all();
        $periodoAcademico = PeriodoAcademico::all();
        $docentes = Docente::all();

        DB::table('unidad_curricular_periodo_academico')->insert([
            [
                'unidad_curricular_id' =>$unidadCurricular->random()->id,
                'periodo_academico_id' => 2,
                'docente_id' => $docentes->random()->id,
                'sede' => 'Atlántico',
                'modalidad' => fake()->randomElement(['Virtual', 'Presencial']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unidad_curricular_id' =>$unidadCurricular->random()->id,
                'periodo_academico_id' => 2,
                'docente_id' => $docentes->random()->id,
                'sede' => 'Atlántico',
                'modalidad' => fake()->randomElement(['Virtual', 'Presencial']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unidad_curricular_id' =>$unidadCurricular->random()->id,
                'periodo_academico_id' => 2,
                'docente_id' => $docentes->random()->id,
                'sede' => 'Atlántico',
                'modalidad' => fake()->randomElement(['Virtual', 'Presencial']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unidad_curricular_id' =>$unidadCurricular->random()->id,
                'periodo_academico_id' => 2,
                'docente_id' => $docentes->random()->id,
                'sede' => 'Atlántico',
                'modalidad' => fake()->randomElement(['Virtual', 'Presencial']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unidad_curricular_id' =>$unidadCurricular->random()->id,
                'periodo_academico_id' => 2,
                'docente_id' => $docentes->random()->id,
                'sede' => 'Atlántico',
                'modalidad' => fake()->randomElement(['Virtual', 'Presencial']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unidad_curricular_id' =>$unidadCurricular->random()->id,
                'periodo_academico_id' => 2,
                'docente_id' => $docentes->random()->id,
                'sede' => 'Atlántico',
                'modalidad' => fake()->randomElement(['Virtual', 'Presencial']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
