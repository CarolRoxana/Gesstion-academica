<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TalentoHumano;

class TalentoHumanoSeeder extends Seeder
{
    public function run()
    {
        TalentoHumano::insert([
            [ 'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'cedula' => '12345678',
                'correo' => 'juan@gmail.com',
                'telefono' => '04121234567',
                'fecha_postulacion' => now(),
                'motivo' => 'Interés en trabajar en el área de desarrollo.',
                'carrera_postulacion' => 'Ingeniería de Sistemas',
                'unidad_curricular_postulacion' => 'Programación I',
                'estatus' => 'Pendiente',
                'observaciones' => 'Excelente perfil.',
                'fecha_aprobacion' => null,
                'fecha_ingreso' => now(),
            ],
            [ 'nombre' => 'Hernesto',
                'apellido' => 'Gonzalez',
                'cedula' => '12387654',
                'correo' => 'Gonzalesh@gmail.com',
                'telefono' => '04121234567',
                'fecha_postulacion' => now(),
                'motivo' => 'Mejorar el nivel matemático en la institución.',
                'carrera_postulacion' => 'Ingeniería de Sistemas',
                'unidad_curricular_postulacion' => 'Matemáticas IV',
                'estatus' => 'Pendiente',
                'observaciones' => 'Excelente perfil.',
                'fecha_aprobacion' => null,
                'fecha_ingreso' => now(),
            ],
            [ 'nombre' => 'Ana',
                'apellido' => 'Martinez',
                'cedula' => '12345678',
                'correo' => 'ana25@gmail.com',
                'telefono' => '04121234567',
                'fecha_postulacion' => now(),
                'motivo' => 'Impartir recursos de IA.',
                'carrera_postulacion' => 'Ingeniería de Sistemas',
                'unidad_curricular_postulacion' => 'Introducción a la IA',
                'estatus' => 'Pendiente',
                'observaciones' => 'Excelente perfil.',
                'fecha_aprobacion' => null,
                'fecha_ingreso' => now(),
            ],

        ]);

    }
}
