<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanEvaluacionDocente extends Model
{
    use HasFactory;

    protected $table = 'plan_evaluacion_docente';

    protected $fillable = [
        'unidad_curricular_periodo_academico_id',
        'porcentaje_evaluacion',
        'fecha_evaluacion',
        'tipo_evaluacion',
        'docente_id',
    ];
    
    protected $casts = [
        'fecha_evaluacion' => 'date',
    ];

    public function unidadCurricularPeriodoAcademico()
    {
        return $this->belongsTo(UnidadCurricularPeriodoAcademico::class);
    }
    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}
