<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentoHumano extends Model
{
    use HasFactory;

    protected $table = 'talento_humano';

    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'correo',
        'telefono',
        'fecha_postulacion',
        'motivo',
        'carrera_postulacion',
        'unidad_curricular_postulacion',
        'estatus',
        'observaciones',
        'fecha_aprobacion',
        'fecha_ingreso',
    ];
}
