<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $table = 'partido';

    protected $fillable = [
        'id_torneo',
        'id_grupo',
        'fase',
        'fecha',
        'hora',
        'id_municipio',
        'jugado',
    ];

     public function torneo()
    {
        return $this->belongsTo(Torneos::class, 'id_torneo');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }

    public function municipio()
    {
        return $this->belongsTo(municipios::class, 'id_municipio');
    }

    public function equipos()
    {
        return $this->belongsToMany(Equipos::class, 'partido_equipos', 'id_partido', 'id_equipo')
                    ->withPivot('rol', 'goles')
                    ->withTimestamps();
    }

}
