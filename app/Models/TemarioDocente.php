<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemarioDocente extends Model
{
    use HasFactory;

    protected $table = 'temario_docente';

    protected $fillable = [
        'unidad_curricular_periodo_academico_id',
        'contenido',
        'fecha_agregado',
    ];

    public function unidadCurricularPeriodoAcademico()
    {
        return $this->belongsTo(UnidadCurricularPeriodoAcademico::class);
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($temario) {
            if (request()->hasFile('contenido')) {
                $file = request()->file('contenido');
                $temario->contenido = $file->store('temarios', 'public');
            }
        });
    }

    public function unidadCurricular()
    {
        return $this->belongsTo(UnidadCurricular::class);
    }

    public function periodoAcademico()
    {
        return $this->belongsTo(PeriodoAcademico::class);
    }
}
