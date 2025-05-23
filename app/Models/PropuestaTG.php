<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropuestaTG extends Model
{
    use HasFactory;

    protected $table = 'propuesta_tg';

    protected $fillable = [
        'nombre_tesista',
        'apellido_tesista',
        'cedula',
        'carrera',
        'nombre_tesista2',
        'apellido_tesista2',
        'cedula2',
        'carrera2',
        'nombre_tesista3',
        'apellido_tesista3',
        'cedula3',
        'carrera3',
        'titulo_propuesta',
        'propuesta',
        'docente_id',
        'estatus',
        'fecha_ingreso',
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}
