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
