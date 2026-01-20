<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquiposSeeder extends Seeder
{
    public function run(): void
    {
        $equipos = [
            ['nombre' => 'Brasil',        'escudo' => 'brasil.png',       'entrenador' => 'Luiz Felipe Scolari'],
            ['nombre' => 'México',        'escudo' => 'mexico.png',       'entrenador' => 'Miguel Herrera'],
            ['nombre' => 'Países Bajos',  'escudo' => 'paisesbajos.png',  'entrenador' => 'Louis van Gaal'],
            ['nombre' => 'Chile',         'escudo' => 'chile.png',        'entrenador' => 'Jorge Sampaoli'],
            ['nombre' => 'Colombia',      'escudo' => 'colombia.png',     'entrenador' => 'José Pékerman'],
            ['nombre' => 'Grecia',        'escudo' => 'grecia.png',       'entrenador' => 'Fernando Santos'],
            ['nombre' => 'Costa Rica',    'escudo' => 'costa_rica.png',   'entrenador' => 'Jorge Luis Pinto'],
            ['nombre' => 'Uruguay',       'escudo' => 'uruguay.png',      'entrenador' => 'Óscar Tabárez'],
            ['nombre' => 'Francia',       'escudo' => 'francia.png',      'entrenador' => 'Didier Deschamps'],
            ['nombre' => 'Suiza',         'escudo' => 'suiza.png',        'entrenador' => 'Ottmar Hitzfeld'],
            ['nombre' => 'Argentina',     'escudo' => 'argentina.png',    'entrenador' => 'Alejandro Sabella'],
            ['nombre' => 'Nigeria',       'escudo' => 'nigeria.png',      'entrenador' => 'Stephen Keshi'],
            ['nombre' => 'Alemania',      'escudo' => 'alemania.png',     'entrenador' => 'Joachim Löw'],
            ['nombre' => 'Estados Unidos','escudo' => 'usa.png',          'entrenador' => 'Jürgen Klinsmann'],
            ['nombre' => 'Bélgica',       'escudo' => 'belgica.png',      'entrenador' => 'Marc Wilmots'],
            ['nombre' => 'Argelia',       'escudo' => 'argelia.png',      'entrenador' => 'Vahid Halilhodžić'],
        ];

        foreach ($equipos as $equipo) {
            DB::table('equipos')->insert([
                'nombre' => $equipo['nombre'],
                'escudo' => $equipo['escudo'],
                'entrenador' => $equipo['entrenador'],
                'estado' => 'activo',
                'idMunicipio' => 1, // ⚠️ Cambia a un ID válido
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
