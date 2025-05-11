<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadCurricular extends Model
{
    use HasFactory;

    protected $table = 'unidad_curricular';

    protected $fillable = [
        'nombre',
        'unidad_curricular',
        'carrera',
        'semestre',
    ];

    public function secciones()
    {
        return $this->hasMany(Seccion::class);
    }
    public function periodos()
    {
        return $this->hasMany(UnidadCurricularPeriodoAcademico::class);
    }

    public function horarios()
{
    return $this->hasMany(Horario::class);
}
}
