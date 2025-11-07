<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo_Equipo extends Model
{
    use HasFactory;

    protected $table = 'torneo_equipo';

    protected $fillable = [
        'idTorneo',
        'idEquipo',
        'grupo'
    ];

    // La tabla sí tiene timestamps
    public $timestamps = true;

    public function torneo()
    {
        return $this->belongsTo(Torneos::class, 'idTorneo');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipos::class, 'idEquipo');
    }
}
