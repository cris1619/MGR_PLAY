<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';

    protected $fillable = [
        'nombre',
        'idTorneo',
    ];

    public function torneo()
    {
        return $this->belongsTo(Torneos::class, 'idTorneo');
    }

    public function equipos()
    {
        return $this->belongsToMany(Equipos::class, 'grupo_equipos', 'idGrupo', 'idEquipo');
    }

    public function partidos()
    {
        return $this->hasMany(Partido::class, 'id_grupo');
    }
}
