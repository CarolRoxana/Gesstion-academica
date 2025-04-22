<?php

namespace Database\Seeders;

use App\Models\DesempenoDocente;
use Illuminate\Database\Seeder;

class DesempenoDocenteSeeder extends Seeder
{
    public function run(): void
    {
        DesempenoDocente::factory()->count(10)->create();
    }
}

