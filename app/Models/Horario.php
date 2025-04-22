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
        'dia' => 'datetime',
        'hora_inicio' => 'datetime',
        'hora_finalizacion' => 'datetime',
    ];

        public function docente()
    {
        return $this->belongsTo(docente::class);
    }

    public function unidadCurricular()
    {
        return $this->belongsTo(unidadCurricular::class);
    }

    public function periodoAcademico()
    {
        return $this->belongsTo(PeriodoAcademico::class);
    }


}
