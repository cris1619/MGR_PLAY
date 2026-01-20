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
}
