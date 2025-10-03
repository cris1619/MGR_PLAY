<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Torneos extends Model
{

    protected $table = 'torneos';
     protected $fillable = [
        'idMunicipio',
        'nombre',
        'descripcion',
        'logo',
        'numeroEquipos',
        'estado',
        'tipoDeporte',
        'formato',
        'fechaInicio',
        'fechaFin',
        'reglas',
        'premio',
    ];

    public function municipio()
    {
        return $this->belongsTo(Municipios::class, 'idMunicipio');
    }

}
