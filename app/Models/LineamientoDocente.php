<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineamientoDocente extends Model
{
    use HasFactory;

    protected $table = 'lineamiento_docente';

    protected $fillable = [
        'docente_id',
        'fecha_supervision',
        'resumen',
        'cumple_lineamientos',
        'observaciones',
        'periodo_academico_id',
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function periodoAcademico()
    {
        return $this->belongsTo(PeriodoAcademico::class);
    }
}
