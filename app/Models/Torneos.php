<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Torneos extends Model
{
    protected $table = 'torneos';
    protected $fillable = [
        'idAdmin',
        'idMunicipio',
        'nombre',
        'descripcion',
        'tipo',
        'estado',
        'fecha_inicio',
        'fecha_fin',
        'num_equipos',
        'cantidad_grupos',
        'equipos_por_grupo',
        'clasificados_por_grupo',
        'partidos_por_enfrentamiento',
        'premio',
    ];

    public function equipos()
    {
        return $this->belongsToMany(Equipos::class, 'Torneo_Equipo', 'id_torneo', 'id_equipo')
                    ->withPivot('grupo')->withTimestamps();
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'id_torneo');
    }

    public function partidos()
    {
        return $this->hasMany(Partido::class, 'id_torneo');
    }
}
