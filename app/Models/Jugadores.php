<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jugadores extends Model
{
    protected $table = 'jugadores';
    protected $fillable = [
        'nombre',
        'apellido',
        'posicion',
        'fechaNacimiento',
        'altura',
        'peso',
        'estado',
        'idEquipo',
    ];
        public function equipos()
        {
            return $this->belongsTo(Equipos::class, 'idEquipo');
        }

        public function nombreCompleto()
        {
            return $this->nombre . ' ' . $this->apellido;
        }
}
