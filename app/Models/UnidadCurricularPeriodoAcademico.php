<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadCurricularPeriodoAcademico extends Model
{
    use HasFactory;

    protected $table = 'unidad_curricular_periodo_academico';

    protected $fillable = [
        'unidad_curricular_id',
        'periodo_academico_id',
        'docente_id',
        'sede',
        'modalidad',
    ];

        public function unidadCurricular()
    {
        return $this->belongsTo(UnidadCurricular::class);
    }

    public function periodoAcademico()
    {
        return $this->belongsTo(PeriodoAcademico::class);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class)->withDefault();
    }
    
}
