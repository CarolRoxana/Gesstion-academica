<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuerpoHorario extends Model
{
    use HasFactory;

    protected $table = 'cuerpo_horario';

    protected $fillable = [
        "descripcion",
    ];
}
