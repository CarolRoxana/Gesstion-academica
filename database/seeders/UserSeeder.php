<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'testadmin@gmail.com',
            'password' => bcrypt('testadmin@gmail.com'),
        ])->assignRole('Admin');


        \App\Models\User::factory()->create([
            'name' => 'Secretaria',
            'email' => 'secretaria@gmail.com',
            'password' => bcrypt('secretaria@gmail.com'),
        ])->assignRole('Secretaria');

        \App\Models\User::factory()->create([
            'name' => 'Coordinador',
            'email' => 'coordinador@gmail.com',
            'password' => bcrypt('coordinador@gmail.com'),
        ])->assignRole('Coordinador');

        \App\Models\User::factory()->create([
            'name' => 'Jefe area',
            'email' => 'jefeArea@gmail.com',
            'password' => bcrypt('jefeArea@gmail.com'),
        ])->assignRole('Jefe area');

        \App\Models\User::factory()->create([
            'name' => 'Jefe departamento',
            'email' => 'jefeDepartamento@gmail.com',
            'password' => bcrypt('jefeDepartamento@gmail.com'),
        ])->assignRole('Jefe departamento');


        \App\Models\User::factory()->create([
            'name' => 'Docente',
            'email' => 'docente@gmail.com',
            'password' => bcrypt('docente@gmail.com'),
        ])->assignRole('Docente');
    }
}
