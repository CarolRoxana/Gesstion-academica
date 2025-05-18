<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
