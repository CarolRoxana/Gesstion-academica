<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioComunitario extends Model
{
    use HasFactory;
    
    protected $table = 'servicio_comunitarios';

    protected $fillable = [
        'nombre_estudiante',
        'apellido_estudiante',
        'cedula',
        'carrera',
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
