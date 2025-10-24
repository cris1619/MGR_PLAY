<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo_Equipo extends Model
{
    protected $table = 'grupo_equipos';

    protected $fillable = [
        'idGrupo',
        'idEquipo',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'idGrupo');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipos::class, 'idEquipo');
    }
}
