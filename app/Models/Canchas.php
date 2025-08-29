<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Canchas extends Model
{
    protected $table = 'canchas';

    protected $fillable = [
        'nombre',
        'idMunicipio'
    ];
}
