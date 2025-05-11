<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Docente;
use App\Models\Seccion;
use App\Models\UnidadCurricular;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UnidadCurricularSeeder extends Seeder
{
    public function run(): void
{
    $unidades = [
        ['nombre' => 'INFORMÁTICA INDUSTRIAL', 'semestre' => 3],
        ['nombre' => 'INNOVACIÓN Y DESARROLLO', 'semestre' => 3],
        ['nombre' => 'DESARROLLOS WEB', 'semestre' => 4],
        ['nombre' => 'COMPUTACIÓN GRÁFICA', 'semestre' => 4],
        ['nombre' => 'TRANSFERENCIA DE TECNOLOGIA', 'semestre' => 4],
        ['nombre' => 'SEMINARIO DE INVESTIGACION', 'semestre' => 5],
        ['nombre' => 'REDES DE COMPUTADORAS I', 'semestre' => 5],
        ['nombre' => 'INGENIERÍA DEL SOFTWARE II', 'semestre' => 6],
        ['nombre' => 'LENGUAJES Y COMPILADORES', 'semestre' => 6],
        ['nombre' => 'TENDENCIAS INFORMÁTICAS', 'semestre' => 7],
    ];

    foreach ($unidades as $unidadData) {
        $unidad = UnidadCurricular::create([
            'nombre' => $unidadData['nombre'],
            'unidad_curricular' => 4,
            'carrera' => 'Ingeniería de Informática',
            'semestre' => $unidadData['semestre'],
        ]);

        foreach (['1', '2', '3'] as $num) {
            Seccion::create([
                'nombre' => $num,
                'unidad_curricular_id' => $unidad->id,
            ]);
        }
    }
}


}
