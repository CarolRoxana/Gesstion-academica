<?php

namespace Database\Factories;

use App\Models\Horario;
use App\Models\Docente;
use App\Models\UnidadCurricular;
use App\Models\PeriodoAcademico;
use App\Models\Seccion;
use Illuminate\Database\Eloquent\Factories\Factory;

class HorarioFactory extends Factory
{
    public function definition(): array
    {
        $horaInicio = $this->faker->time('H:i');
        $horaFin = date('H:i', strtotime('+2 hours', strtotime($horaInicio)));
    
        return [
            'docente_id' => Docente::inRandomOrder()->first()?->id ?? 1,
            'dia' => $this->faker->randomElement(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']),
            'hora_inicio' => $horaInicio,
            'hora_finalizacion' => $horaFin,
            'unidad_curricular_id' => UnidadCurricular::inRandomOrder()->first()?->id ?? 1,
            'seccion_id' => Seccion::inRandomOrder()->first()?->id ?? 1,
            'periodo_academico_id' => 2,
        ];
    }
}
