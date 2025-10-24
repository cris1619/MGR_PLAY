<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipos extends Model
{
    protected $table = 'equipos';
    protected $fillable = [
        'nombre',
        'escudo',
        'entrenador',
        'estado',
        'idMunicipio'];

    public function municipio()
        {
            return $this->belongsTo(Municipios::class, 'idMunicipio');
        }

        public function jugadores()
        {
            return $this->hasMany(Jugadores::class, 'idEquipo');
        }

        public function torneos()
        {
            return $this->belongsToMany(Torneos::class, 'torneo_equipo', 'idEquipo', 'idTorneo');
        }

    public function grupos()
        {
            return $this->belongsToMany(Grupo::class, 'grupo_equipos', 'idEquipo', 'idGrupo');
        }

    public function partidos()
        {
            return $this->belongsToMany(Partido::class, 'partido_equipos', 'id_equipo', 'id_partido')
                        ->withPivot('rol', 'goles')
                        ->withTimestamps();
        }

    public function clasificacion()
        {
            return $this->hasMany(Clasificacion::class, 'id_equipo');
        }
    }
