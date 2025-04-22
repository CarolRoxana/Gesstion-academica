<?php
// database/seeders/DocenteSeeder.php

namespace Database\Seeders;

use App\Models\Docente;
use Illuminate\Database\Seeder;

class DocenteSeeder extends Seeder
{
    public function run(): void
    {
        Docente::insert([
            [
                'rol_id' => 3,
                'nombre' => 'Luis',
                'apellido' => 'González',
                'cedula' => 'V-12345678',
                'correo' => 'luis.gonzalez@example.com',
                'telefono' => '04141234567',
                'titulo' => 'Ingeniero en Computación',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rol_id' => 3,
                'nombre' => 'María',
                'apellido' => 'Pérez',
                'cedula' => 'V-87654321',
                'correo' => 'maria.perez@example.com',
                'telefono' => '04147654321',
                'titulo' => 'Licenciada en Educación',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Docente::factory()->count(10)->create();
    }
}
