<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre', 'unidad_curricular_id'];

    public function unidadCurricular()
    {
        return $this->belongsTo(UnidadCurricular::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
