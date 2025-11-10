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

        public function grupos()
{
    return $this->belongsToMany(
        Grupo::class,
        'grupo_equipos', // ✅ mismo nombre
        'idEquipo',
        'idGrupo'
    );
}

}
