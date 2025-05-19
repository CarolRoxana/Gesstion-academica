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
        ])->assignRole('admin');

        // \App\Models\User::factory()->create([
        //     'name' => 'User',
        //     'email' => 'testuser@gmail.com',
        //     'password' => bcrypt('p$ssw#rd'),
        // ])->assignRole('user');

        \App\Models\User::factory()->create([
            'name' => 'Secretaria',
            'email' => 'secretaria@gmail.com',
            'password' => bcrypt('p$ssw#rd'),
        ])->assignRole('Secretaria');

        \App\Models\User::factory()->create([
            'name' => 'Coordinador',
            'email' => 'coordinador@gmail.com',
            'password' => bcrypt('p$ssw#rd'),
        ])->assignRole('Coordinador');

        \App\Models\User::factory()->create([
            'name' => 'Jefe area',
            'email' => 'jefeArea@gmail.com',
            'password' => bcrypt('p$ssw#rd'),
        ])->assignRole('Jefe area');

        \App\Models\User::factory()->create([
            'name' => 'Jefe departamento',
            'email' => 'jefeDepartamento@gmail.com',
            'password' => bcrypt('p$ssw#rd'),
        ])->assignRole('Jefe departamento');
    }
}
