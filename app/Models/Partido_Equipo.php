<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partido_Equipo extends Model
{
    protected $table = 'partido_equipos';

    // Columnas que se pueden llenar masivamente
    protected $fillable = [
        'id_partido',
        'id_equipo',
        'rol',
        'goles',
    ];

    // Relación con Partido
    public function partido()
    {
        return $this->belongsTo(Partido::class, 'id_partido');
    }

    // Relación con Equipo
    public function equipo()
    {
        return $this->belongsTo(Equipos::class, 'id_equipo');
    }
}
