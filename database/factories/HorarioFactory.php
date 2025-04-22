<?php

namespace Database\Factories;

use App\Models\Horario;
use App\Models\Docente;
use App\Models\UnidadCurricular;
use App\Models\PeriodoAcademico;
use Illuminate\Database\Eloquent\Factories\Factory;

class HorarioFactory extends Factory
{
    public function definition(): array
    {
        $horaInicio = $this->faker->dateTimeBetween('08:00', '16:00');
        $horaFin = (clone $horaInicio)->modify('+2 hours');

        return [
            'docente_id' => Docente::inRandomOrder()->first()->id,
            'dia' => $this->faker->dateTimeBetween('this week', '+1 week'),
            'hora_inicio' => $horaInicio,
            'hora_finalizacion' => $horaFin,
            'unidad_curricular_id' => UnidadCurricular::inRandomOrder()->first()->id,
            'seccion' => $this->faker->randomElement(['1', '2', '3', '4']),
            'periodo_academico_id' => 2,
        ];
    }
}
