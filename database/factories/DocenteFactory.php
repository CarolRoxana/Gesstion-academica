<?php
// database/factories/DocenteFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DocenteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'rol_id' => 3,
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'cedula' => 'V-' . $this->faker->unique()->numberBetween(10000000, 30000000),
            'correo' => $this->faker->unique()->safeEmail,
            'telefono' => '0414' . $this->faker->numberBetween(1000000, 9999999),
            'titulo' => $this->faker->randomElement([
                'Ingeniero en Computación',
                'Licenciado en Matemáticas',
                'Doctor en Educación',
                'Magíster en Ciencias',
            ]),
        ];
    }
}
