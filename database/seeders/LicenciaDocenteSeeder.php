<?php

namespace Database\Seeders;

use App\Models\LicenciaDocente;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class LicenciaDocenteSeeder extends Seeder
{
    public function run(): void
    {
        LicenciaDocente::create([
            'id_user' => 1,
            'nombre_curso' => 'Curso de Innovación Educativa',
            'institucion' => 'Universidad Central',
            'tipo_curso' => 'Diplomado',
            'fecha_inicio' => Carbon::now()->subMonth(),
            'fecha_fin' => Carbon::now()->addMonth(),
            'estatus' => 'En proceso',
            'justificacion' => 'Mejorar métodos de enseñanza',
        ]);

        LicenciaDocente::create([
            'id_user' => 2,
            'nombre_curso' => 'Metodología STEAM',
            'institucion' => 'Instituto Pedagógico',
            'tipo_curso' => 'Taller',
            'fecha_inicio' => Carbon::now()->subWeeks(2),
            'fecha_fin' => Carbon::now()->addWeeks(4),
            'estatus' => 'Aprobado',
            'fecha_aprobacion' => Carbon::now()->subDays(5),
        ]);

        LicenciaDocente::create([
            'id_user' => 3,
            'nombre_curso' => 'Curso de Liderazgo Educativo',
            'institucion' => 'Fundación Educar',
            'tipo_curso' => 'Curso',
            'fecha_inicio' => Carbon::now()->addDays(10),
            'fecha_fin' => Carbon::now()->addDays(40),
            'estatus' => 'Pendiente',
        ]);
    }
}
