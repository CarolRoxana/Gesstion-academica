<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoInterSemestral extends Model
{
    use HasFactory;

    protected $table = 'curso_inter_semestral';

    protected $fillable = [
        'docente_id',
        'nombre_curso',
        'descripcion',
        'modalidad',
        'fecha_inicio',
        'fecha_fin',
        'cupos_max',
        'estatus',
        'exponente',
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}
