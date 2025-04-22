<?php

// database/factories/IncidenteEstudiantilFactory.php

namespace Database\Factories;

use App\Models\Docente;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncidenteEstudiantilFactory extends Factory
{
    public function definition(): array
    {
        return [
            'docente_id' => Docente::inRandomOrder()->first()?->id ?? Docente::factory(), // Crea uno si no hay
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'cedula' => 'V-' . $this->faker->unique()->numberBetween(10000000, 30000000),
            'carrera' => $this->faker->randomElement([
                'Ingeniería Informática',
            ]),
            'semestre' => $this->faker->randomElement(['1ro', '2do', '3ro', '4to', '5to', '6to', '7mo', '8vo']),
            'incidente' => $this->faker->randomElement([
                'Inasistencias frecuentes',
                'Incumplimiento de normas',
                'Violencia verbal',
                'Retrasos reiterados',
            ]),
            'descripcion' => $this->faker->optional()->paragraph,
            'fecha_incidente' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
