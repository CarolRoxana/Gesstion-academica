<?php

namespace Database\Seeders;

use App\Models\TemarioDocente;
use App\Models\UnidadCurricularPeriodoAcademico;
use Illuminate\Database\Seeder;

class TemarioDocenteSeeder extends Seeder
{
    public function run()
    {
        $uc_pa = UnidadCurricularPeriodoAcademico::all();

        TemarioDocente::create([
            'unidad_curricular_periodo_academico_id' =>$uc_pa->random()->id,
            'contenido' => 'temario1.pdf',
            'fecha_agregado' => now(),
        ]);

        TemarioDocente::create([
            'unidad_curricular_periodo_academico_id' => $uc_pa->random()->id,
            'contenido' => 'temario2.pdf',
            'fecha_agregado' => now(),
        ]);

        TemarioDocente::create([
            'unidad_curricular_periodo_academico_id' => $uc_pa->random()->id,
            'contenido' => 'temario3.pdf',
            'fecha_agregado' => now(),
        ]);
    }
}
