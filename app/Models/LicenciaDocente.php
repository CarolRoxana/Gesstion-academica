<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenciaDocente extends Model
{
    use HasFactory;

    protected $table = 'licencia_docente';

    protected $fillable = [
        'id_user',
        'nombre_curso',
        'institucion',
        'tipo_curso',
        'fecha_inicio',
        'fecha_fin',
        'estatus',
        'justificacion',
        'fecha_aprobacion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
