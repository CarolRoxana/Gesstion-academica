<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioComunitario extends Model
{
    use HasFactory;
    
    protected $table = 'servicio_comunitarios';
    
    protected $fillable = [
        // Primer estudiante
        'nombre_estudiante',
        'apellido_estudiante',
        'cedula',
        'carrera',

        // Segundo estudiante
        'nombre_estudiante2',
        'apellido_estudiante2',
        'cedula2',
        'carrera2',

        // Tercer estudiante
        'nombre_estudiante3',
        'apellido_estudiante3',
        'cedula3',
        'carrera3',

        // Cuarto estudiante
        'nombre_estudiante4',
        'apellido_estudiante4',
        'cedula4',
        'carrera4',

        // Quinto estudiante
        'nombre_estudiante5',
        'apellido_estudiante5',
        'cedula5',
        'carrera5',

        // Sexto estudiante
        'nombre_estudiante6',
        'apellido_estudiante6',
        'cedula6',
        'carrera6',

        // Otros campos
        'titulo_servicio',
        'trabajo_servicio',
        'docente_id',
        'estatus',
        'fecha_ingreso',
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}
