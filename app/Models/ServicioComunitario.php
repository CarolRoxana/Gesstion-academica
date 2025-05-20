<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioComunitario extends Model
{
    use HasFactory;
    
    protected $table = 'servicio_comunitarios';
    
    protected $fillable = [
        'estudiantes',
        'titulo_servicio',
        'trabajo_servicio',
        'docente_id',
        'estatus',
        'fecha_ingreso',
    ];

    protected $casts = [
        'estudiantes' => 'array',
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}
