<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Docente;
use App\Models\UnidadCurricular;
use App\Models\PeriodoAcademico;


class Horario extends Model
{
    use HasFactory;

    protected $casts = [
        'hora_inicio' => 'datetime:H:i',
        'hora_finalizacion' => 'datetime:H:i',
    ];

    protected $fillable = [
        'docente_id',
        'dia',
        'hora_inicio',
        'hora_finalizacion',
        'unidad_curricular_id',
        'seccion_id',
        'periodo_academico_id',
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function unidadCurricular()
    {
        return $this->belongsTo(UnidadCurricular::class);
    }

    public function periodoAcademico()
    {
        return $this->belongsTo(PeriodoAcademico::class);
    }

    public function seccion()
    {
        return $this->belongsTo(Seccion::class);
    }
}

