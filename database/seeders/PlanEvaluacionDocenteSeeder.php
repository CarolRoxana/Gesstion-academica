<?php

namespace Database\Seeders;

use App\Models\PlanEvaluacionDocente;
use App\Models\UnidadCurricularPeriodoAcademico;
use Illuminate\Database\Seeder;

class PlanEvaluacionDocenteSeeder extends Seeder
{
    public function run()
    {
        $tiposEvaluacion = [
            ['tipo' => 'Examen final', 'porcentaje' => 30],
            ['tipo' => 'Evaluación continua', 'porcentaje' => 25],
            ['tipo' => 'Trabajo final', 'porcentaje' => 25],
            ['tipo' => 'Participación', 'porcentaje' => 20],
        ];

        $uc_pa = UnidadCurricularPeriodoAcademico::all();

        foreach ($uc_pa as $unidad) {
            foreach ($tiposEvaluacion as $evaluacion) {
                PlanEvaluacionDocente::create([
                    'unidad_curricular_periodo_academico_id' => $unidad->id,
                    'porcentaje_evaluacion' => $evaluacion['porcentaje'],
                    'fecha_evaluacion' => now(),
                    'tipo_evaluacion' => $evaluacion['tipo'],
                ]);
            }
        }
    }
}
