<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Docente;
use App\Models\PeriodoAcademico;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LineamientoDocente>
 */
class LineamientoDocenteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'docente_id' => Docente::inRandomOrder()->first()?->id ?? 1,
            'fecha_supervision' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'resumen' => $this->faker->sentence(6),
            'cumple_lineamientos' => $this->faker->randomElement(['Sí', 'No', 'Parcialmente']),
            'observaciones' => $this->faker->optional()->paragraph(),
            'periodo_academico_id' => PeriodoAcademico::inRandomOrder()->first()?->id ?? 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
