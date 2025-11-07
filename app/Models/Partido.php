<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $table = 'partidos'; // ✅ aseguras nombre correcto

    protected $fillable = [
        'id_torneo',
        'id_grupo',
        'fase',
        'fecha',
        'hora',
        'id_municipio',
        'jugado'
    ];
}
