<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidenteEstudiantil extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'incidentes_estudiantiles';

    protected $fillable = [
        'docente_id',
        'nombre',
        'apellido',
        'cedula',
        'carrera',
        'semestre',
        'incidente',
        'descripcion',
        'fecha_incidente',
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}
