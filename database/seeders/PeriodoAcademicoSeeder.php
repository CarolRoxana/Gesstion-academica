<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PeriodoAcademicoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('periodo_academico')->insert([
            [
                'periodo' => '2025 - I',
                'fecha_inicio' => Carbon::create(2025, 1, 15),
                'fecha_finalizacion' => Carbon::create(2025, 6, 30),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'periodo' => '2025 - II',
                'fecha_inicio' => Carbon::create(2025, 7, 1),
                'fecha_finalizacion' => Carbon::create(2025, 12, 15),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
