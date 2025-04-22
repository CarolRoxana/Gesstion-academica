<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodoAcademico extends Model
{
    use HasFactory;

    protected $table = 'periodo_academico';

    protected $fillable = [
        'periodo',
        'fecha_inicio',
        'fecha_finalizacion',
    ];

    public function unidadCurricularPeriodoAcademico()
    {
        return $this->hasMany(UnidadCurricularPeriodoAcademico::class);
    }
}
