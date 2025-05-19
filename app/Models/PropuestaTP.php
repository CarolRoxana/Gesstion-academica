<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropuestaTP extends Model
{
    use HasFactory;

    protected $table = 'propuesta_tp';

    protected $fillable = [
        'nombre_pasante',
        'apellido_pasante',
        'cedula',
        'carrera',
        'nombre_pasante2',
        'apellido_pasante2',
        'cedula2',
        'carrera2',
        'nombre_pasante3',
        'apellido_pasante3',
        'cedula3',
        'carrera3',
        'titulo_propuesta',
        'plan_trabajo',
        'docente_id',
        'estatus',
        'fecha_ingreso',
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}
