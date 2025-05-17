<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropuestaTp;
use App\Models\Docente;

class PropuestaTpSeeder extends Seeder
{
    public function run(): void
    {
        $docentes = Docente::all();

        if ($docentes->count() === 0) {
            $this->command->info('No hay docentes en la base de datos. Se necesita al menos uno.');
            return;
        }

        foreach (range(1, 10) as $i) {
            PropuestaTp::create([
                'nombre_pasante' => fake()->firstName(),
                'apellido_pasante' => fake()->lastName(),
                'cedula' => fake()->unique()->numerify('V########'),
                'carrera' => fake()->randomElement(['Ingeniería', 'Sistemas', 'Contaduría']),
                'titulo_propuesta' => fake()->sentence(5),
                'plan_trabajo' => fake()->paragraph(3),
                'docente_id' => $docentes->random()->id,
                'estatus' => fake()->randomElement(['En Proceso', 'Aprobado', 'Pendiente', 'Rechazado']),
                'fecha_ingreso' => now()->subDays(rand(0, 90)),
            ]);
        }
    }
}
