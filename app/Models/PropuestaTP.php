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
        'titulo_propuesta',
        'docente_id',
        'estatus',
        'fecha_ingreso',
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}
