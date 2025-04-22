<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropuestaTg;
use App\Models\Docente;

class PropuestaTgSeeder extends Seeder
{
    public function run(): void
    {
        $docentes = Docente::all();

        if ($docentes->count() === 0) {
            $this->command->info('No hay docentes en la base de datos. Se necesita al menos uno.');
            return;
        }

        foreach (range(1, 10) as $i) {
            PropuestaTg::create([
                'nombre_tesista' => fake()->firstName(),
                'apellido_tesista' => fake()->lastName(),
                'cedula' => fake()->unique()->numerify('V########'),
                'carrera' => fake()->randomElement(['Ingeniería', 'Administración', 'Educación']),
                'titulo_propuesta' => fake()->sentence(6),
                'propuesta' => fake()->text(200),
                'docente_id' => $docentes->random()->id,
                'estatus' => fake()->randomElement(['En Revisión', 'Aprobada', 'Rechazada']),
                'fecha_ingreso' => now()->subDays(rand(0, 60)),
            ]);
        }
    }
}
