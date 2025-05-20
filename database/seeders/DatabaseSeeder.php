<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DocenteSeeder::class);
        // $this->call(CursoInterSemestralSeeder::class);
        // $this->call(LicenciaDocenteSeeder::class);
        // $this->call(IncidenteEstudiantilSeeder::class);
        // $this->call(PeriodoAcademicoSeeder::class);
        // $this->call(UnidadCurricularSeeder::class);
        // $this->call(UnidadCurricularPeriodoAcademicoSeeder::class);
        // $this->call(DesempenoDocenteSeeder::class);
        // $this->call(PlanEvaluacionDocenteSeeder::class);
        // $this->call(TemarioDocenteSeeder::class);
        // $this->call(TalentoHumanoSeeder::class);
        // $this->call(IncidenteEstudiantilSeeder::class);
        // $this->call(HorarioSeeder::class);
        // $this->call(PropuestaTgSeeder::class);
        // $this->call(PropuestaTpSeeder::class);
        // $this->call(LineamientoDocenteSeeder::class);
        // $this->call(DocenteRoleSeeder::class);


    }
}
