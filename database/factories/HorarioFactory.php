<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Horario;
use App\Models\Docente;
use App\Models\UnidadCurricular;
use App\Models\PeriodoAcademico;
use App\Models\Seccion;
use App\Helpers\ArrayHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class HorarioFactory extends Factory
{
    public function definition(): array
    {
        $bloques = ArrayHelper::bloques();
        $maxInicio = count($bloques) - 2; // Para asegurar al menos 1 bloque de diferencia
        $idxInicio = $this->faker->numberBetween(0, $maxInicio);
        // Elegir un fin entre 1 y 3 bloques después del inicio
        $maxFin = min($idxInicio + 3, count($bloques) - 1);
        $idxFin = $this->faker->numberBetween($idxInicio + 1, $maxFin);

        $horaInicio = $bloques[$idxInicio]['start'];
        $horaFin = $bloques[$idxFin]['end'];
        $sede = $this->faker->randomElement(['Atlantico', 'Villa Asia']);




        $horaInicio = Carbon::parse($bloques[$idxInicio]['start'])->format('H:i:s');
        $horaFin = Carbon::parse($bloques[$idxFin]['end'])->format('H:i:s');


        return [
            'docente_id' => Docente::inRandomOrder()->first()?->id ?? 1,
            'dia' => $this->faker->randomElement(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']),
            'hora_inicio' => $horaInicio,
            'hora_finalizacion' => $horaFin,
            'unidad_curricular_id' => UnidadCurricular::inRandomOrder()->first()?->id ?? 1,
            'seccion_id' => Seccion::inRandomOrder()->first()?->id ?? 1,
            'periodo_academico_id' => 2,
            'sede' => $sede,
            'aula_id' => $sede === 'Villa Asia'
                ? $this->faker->numberBetween(1, 4)
                : $this->faker->numberBetween(1, 15),
        ];
    }
}
