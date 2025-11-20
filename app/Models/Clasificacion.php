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
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipos::class, 'idEquipo');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'idGrupo');
    }

}
