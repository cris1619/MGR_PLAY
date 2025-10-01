<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class arbitros extends Model
{
    protected $table="arbitros";

    protected $fillable =[

        'nombre',
        'apellido'
    ];
}
