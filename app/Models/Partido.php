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

    public function partido_equipos()
{
    return $this->hasMany(Partido_Equipo::class, 'id_partido');
}
public function equipos()
{
    return $this->belongsToMany(
        Equipos::class,
        'partido_equipos',
        'id_partido',
        'id_equipo'
    );
}

}
