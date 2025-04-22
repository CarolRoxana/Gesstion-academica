<?php

namespace Database\Factories;

use App\Models\DesempenoDocente;
use App\Models\Docente;
use App\Models\UnidadCurricular;
use App\Models\UnidadCurricularPeriodoAcademico;
use Illuminate\Database\Eloquent\Factories\Factory;

class DesempenoDocenteFactory extends Factory
{
    protected $model = DesempenoDocente::class;

    public function definition(): array
    {
        $unidad_curricular_periodo = UnidadCurricularPeriodoAcademico::inRandomOrder()->first();

        return [
            'docente_id' => Docente::factory(),
            'unidad_curricular_periodo_academico_id' => $unidad_curricular_periodo?->id ?? 1,
            'puntualidad' => $this->faker->numberBetween(1, 10),
            'calidad_ensenanza' => $this->faker->randomElement(['Excelente', 'Buena', 'Regular']),
            'observaciones' => $this->faker->optional()->sentence(),
            'participacion_proyectos' => $this->faker->randomElement(['Alta', 'Media', 'Baja']),
            'cumplimiento_administrativo' => $this->faker->randomElement(['Cumple', 'Parcial', 'No Cumple']),
            'evaluado_por' => $this->faker->name(),
            'fecha_evaluacion' => $this->faker->dateTimeThisYear(),
        ];
    }
}
