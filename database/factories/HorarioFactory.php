<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Docente;
use App\Models\UnidadCurricular;
use App\Models\Seccion;
use App\Helpers\ArrayHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class HorarioFactory extends Factory
{

    public function definition(): array
    {
        $bloques = ArrayHelper::bloques();
        $maxIntentos = 10; // Evita bucles infinitos
        $intentos = 0;

        do {
            $maxInicio = count($bloques) - 2;
            $idxInicio = $this->faker->numberBetween(0, $maxInicio);
            $maxFin = min($idxInicio + 3, count($bloques) - 1);
            $idxFin = $this->faker->numberBetween($idxInicio + 1, $maxFin);

            $horaInicio = Carbon::parse($bloques[$idxInicio]['start'])->format('H:i:s');
            $horaFin = Carbon::parse($bloques[$idxFin]['end'])->format('H:i:s');
            $dia = $this->faker->randomElement(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']);
            $sede = $this->faker->randomElement(['Atlantico', 'Villa Asia']);
            $aula_id = $sede === 'Villa Asia'
                ? $this->faker->numberBetween(1, 4)
                : $this->faker->numberBetween(1, 15);

            $docente_id = Docente::inRandomOrder()->first()?->id ?? 1;
            $unidad_curricular_id = UnidadCurricular::inRandomOrder()->first()?->id ?? 1;
            $seccion_id = Seccion::inRandomOrder()->first()?->id ?? 1;
            $periodo_academico_id = 2;

            // Validaciones de conflicto
            $conflictoDocente = \App\Models\Horario::where('docente_id', $docente_id)
                ->where('dia', $dia)
                ->where('periodo_academico_id', $periodo_academico_id)
                ->where(function ($query) use ($horaInicio, $horaFin) {
                    $query->whereBetween('hora_inicio', [$horaInicio, $horaFin])
                        ->orWhereBetween('hora_finalizacion', [$horaInicio, $horaFin])
                        ->orWhere(function ($q) use ($horaInicio, $horaFin) {
                            $q->where('hora_inicio', '<=', $horaInicio)
                                ->where('hora_finalizacion', '>=', $horaFin);
                        });
                })->exists();

            $conflictoSeccion = \App\Models\Horario::where('seccion_id', $seccion_id)
                ->where('dia', $dia)
                ->where('periodo_academico_id', $periodo_academico_id)
                ->where(function ($query) use ($horaInicio, $horaFin) {
                    $query->whereBetween('hora_inicio', [$horaInicio, $horaFin])
                        ->orWhereBetween('hora_finalizacion', [$horaInicio, $horaFin])
                        ->orWhere(function ($q) use ($horaInicio, $horaFin) {
                            $q->where('hora_inicio', '<=', $horaInicio)
                                ->where('hora_finalizacion', '>=', $horaFin);
                        });
                })->exists();

            $conflictoSede = \App\Models\Horario::where('sede', $sede)
                ->where('aula_id', $aula_id)
                ->where('dia', $dia)
                ->where('periodo_academico_id', $periodo_academico_id)
                ->where(function ($query) use ($horaInicio, $horaFin) {
                    $query->whereBetween('hora_inicio', [$horaInicio, $horaFin])
                        ->orWhereBetween('hora_finalizacion', [$horaInicio, $horaFin])
                        ->orWhere(function ($q) use ($horaInicio, $horaFin) {
                            $q->where('hora_inicio', '<=', $horaInicio)
                                ->where('hora_finalizacion', '>=', $horaFin);
                        });
                })->exists();

            $intentos++;
        } while (($conflictoDocente || $conflictoSeccion || $conflictoSede) && $intentos < $maxIntentos);

        return [
            'docente_id' => $docente_id,
            'dia' => $dia,
            'hora_inicio' => $horaInicio,
            'hora_finalizacion' => $horaFin,
            'unidad_curricular_id' => $unidad_curricular_id,
            'seccion_id' => $seccion_id,
            'periodo_academico_id' => $periodo_academico_id,
            'sede' => $sede,
            'aula_id' => $aula_id,
        ];
    }
}
