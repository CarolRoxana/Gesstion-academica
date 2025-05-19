<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesempenoDocente extends Model
{
    use HasFactory;

    protected $table = 'desempeno_docente';

    protected $fillable = [
        'docente_id',
        'unidad_curricular_periodo_academico_id',
        'puntualidad',
        'calidad_ensenanza',
        'observaciones',
        'participacion_proyectos',
        'cumplimiento_administrativo',
        'evaluado_por',
        'fecha_evaluacion',
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function unidadCurricularPeriodoAcademico()
    {
        return $this->belongsTo(UnidadCurricularPeriodoAcademico::class);
    }
    public function evaluador() 
    {
        return $this->belongsTo(Docente::class, 'evaluado_por');
    }
}
