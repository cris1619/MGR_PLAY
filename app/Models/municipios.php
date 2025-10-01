<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class municipios extends Model
{
    protected $table = 'municipios';

    protected $fillable = [
        'nombre'
    ];

    public function canchas()
    {
        return $this->hasMany(Canchas::class, 'idMunicipio');
    }

    public function equipos()
    {
        return $this->hasMany(Equipos::class, 'idMunicipio');
    }
}
