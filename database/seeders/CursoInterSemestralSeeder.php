<?php

namespace Database\Seeders;

use App\Models\CursoInterSemestral;
use App\Models\Docente;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CursoInterSemestralSeeder extends Seeder
{
    public function run(): void
    {
        $docentes = Docente::all();

        if ($docentes->isEmpty()) return;

        foreach ([
            ['Laravel Básico', 'Curso de introducción a Laravel'],
            ['Vue Avanzado', 'Curso profundo de Vue.js'],
            ['API REST con Laravel', 'Crea APIs con autenticación y recursos']
        ] as $info) {
            CursoInterSemestral::create([
                'docente_id' => $docentes->random()->id,
                'nombre_curso' => $info[0],
                'descripcion' => $info[1],
                'modalidad' => fake()->randomElement(['Virtual', 'Presencial']),
                'fecha_inicio' => Carbon::now()->subDays(rand(5, 30)),
                'fecha_fin' => Carbon::now()->addDays(rand(10, 30)),
                'cupos_max' => rand(10, 30),
                'estatus' => fake()->randomElement(['Abierto', 'Cerrado', 'En proceso']),
                'exponente' => fake()->boolean() ? fake()->name() : null,
            ]);
        }
    }
}
