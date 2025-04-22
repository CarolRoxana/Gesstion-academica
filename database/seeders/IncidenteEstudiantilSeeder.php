<?php

namespace Database\Seeders;

use App\Models\IncidenteEstudiantil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class IncidenteEstudiantilSeeder extends Seeder
{
    public function run(): void
    {
        IncidenteEstudiantil::create([
            'docente_id' => 1,
            'nombre' => 'Carlos',
            'apellido' => 'Ramírez',
            'cedula' => 'V-29876543',
            'carrera' => 'Ingeniería Informática',
            'semestre' => '6to',
            'incidente' => 'Inasistencias frecuentes',
            'descripcion' => 'El Profesor ha faltado a más del 50% de las clases.',
            'fecha_incidente' => Carbon::now()->subDays(10),
        ]);

        IncidenteEstudiantil::create([
            'docente_id' => 2,
            'nombre' => 'María',
            'apellido' => 'Fernández',
            'cedula' => 'V-21564789',
            'carrera' => 'Ingeniería Informática',
            'semestre' => '4to',
            'incidente' => 'Falta de respeto',
            'descripcion' => 'Se reporta altercado verbal con el estudiante.',
            'fecha_incidente' => Carbon::now()->subDays(3),
        ]);

        IncidenteEstudiantil::create([
            'docente_id' => 1,
            'nombre' => 'Luis',
            'apellido' => 'González',
            'cedula' => 'V-33445566',
            'carrera' => 'Ingeniería Informática',
            'semestre' => '8vo',
            'incidente' => 'Expulsión del aula sin causa justa',
            'descripcion' => 'Sacó al estudiante de la clase por hacer una pregunta relacionada con la clase.',
            'fecha_incidente' => Carbon::now()->subWeeks(1),
        ]);

        IncidenteEstudiantil::factory()->count(10)->create();
    }
}
