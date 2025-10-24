<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
     protected $table = 'clasificacion';

    protected $fillable = [
        'id_torneo',
        'id_equipo',
        'grupo',
        'puntos',
        'partidos_jugados',
        'ganados',
        'empatados',
        'perdidos',
        'goles_favor',
        'goles_contra',
        'diferencia_goles',
    ];

    public function torneo()
    {
        return $this->belongsTo(Torneos::class, 'id_torneo');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipos::class, 'id_equipo');
    }
}
