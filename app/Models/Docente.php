<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Docente extends Model
{
    use HasFactory;

protected $fillable = [
    'nombre',
    'apellido',
    'cedula',
    'correo',
    'telefono',
    'titulo',
    'maestria',
    'doctorado',
    'postgrado',
    'otro',
    'categoria',
    'tipo_contratacion',
];

    public function unidadCurricular()
    {
        return $this->hasMany(UnidadCurricular::class);
    }
    
    public function unidadesAsignadasModalidad()
    {
        return $this->hasMany(UnidadCurricularPeriodoAcademico::class);
    }

    public function propuestasTG()
    {
        return $this->hasMany(PropuestaTg::class);
    }

    public function propuestasTP()
    {
        return $this->hasMany(PropuestaTp::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function desempenos()
    {
        return $this->hasMany(DesempenoDocente::class);
    }

    public function unidadesAsignadas()
    {
        return $this->hasMany(Horario::class);
    }

    public function serviciosComunitarios()
    {
        return $this->hasMany(ServicioComunitario::class);
    }

    public function lineamientos()
    {
        return $this->hasMany(LineamientoDocente::class);
    }

     public function temarios(): HasManyThrough
    {
        return $this->hasManyThrough(
            TemarioDocente::class,                 
            UnidadCurricularPeriodoAcademico::class, 
            'docente_id',     
            'unidad_curricular_periodo_academico_id',
            'id',              // clave primaria en Docente
            'id'               // clave primaria en UCPA
        )->orderByDesc('fecha_agregado');
    }

    public function evaluacionesDocente(): HasManyThrough
    {
        return $this->hasManyThrough(
            PlanEvaluacionDocente::class,
            UnidadCurricularPeriodoAcademico::class,
            'docente_id',
            'unidad_curricular_periodo_academico_id',
            'id',
            'id'
        )->orderByDesc('fecha_evaluacion');
    }

}
