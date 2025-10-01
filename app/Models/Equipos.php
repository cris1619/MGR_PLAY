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
}
