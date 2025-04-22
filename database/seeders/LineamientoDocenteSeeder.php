<?php

namespace Database\Seeders;

use App\Models\LineamientoDocente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineamientoDocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LineamientoDocente::factory()->count(20)->create();
    }
}
