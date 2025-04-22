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
    ];

    public function unidadCurricular()
    {
        // return $this->belongsToMany(UnidadCurricular::class, 'docente_unidad_curricular');
        return $this->hasMany(UnidadCurricular::class);
    }
}
