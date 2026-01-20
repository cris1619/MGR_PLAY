<?php

namespace App\Services;

use App\Models\Canchas;
use App\Models\Equipos;
use App\Models\Jugadores;

class userService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function totalJugadores(){
        $totalJugadores = Jugadores::count();
        return $totalJugadores;
    }

    public function totalEquipos(){
        $totalEquipos = Equipos::count();
        return $totalEquipos;
    }

    public function totalCanchas (){
        $totalCanchas = Canchas::count();
        return $totalCanchas;
    }
}
