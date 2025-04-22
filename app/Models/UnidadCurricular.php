<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadCurricular extends Model
{
    use HasFactory;

    protected $table = 'unidad_curricular';

    protected $fillable = [
        'docente_id',
        'nombre',
        'unidad_curricular',
        'carrera',
        'semestre',
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}
