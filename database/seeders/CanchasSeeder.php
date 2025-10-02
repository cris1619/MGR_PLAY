<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CanchasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        
        $canchas = [

            ['nombre' => 'Cancha Principal de Málaga', 'idMunicipio' => 1],
            
            ['nombre' => 'Cancha Alterna del Centro', 'idMunicipio' => 1],

            ['nombre' => 'Polideportivo Capitanejo', 'idMunicipio' => 2],

            ['nombre' => 'Cancha La Playa', 'idMunicipio' => 2],

            ['nombre' => 'Coliseo Municipal Concepción', 'idMunicipio' => 2],

            ['nombre' => 'Cancha Vereda El Centro', 'idMunicipio' => 3],

            ['nombre' => 'Cancha del Parque Cerrito II', 'idMunicipio' => 4],

            ['nombre' => 'Cancha Principal Enciso', 'idMunicipio' => 5],

            ['nombre' => 'Polideportivo Guaca', 'idMunicipio' => 6],

            ['nombre' => 'Cancha Central Macaravita', 'idMunicipio' => 7],

            ['nombre' => 'Cancha del Barrio Abajo', 'idMunicipio' => 8],

            ['nombre' => 'Cancha Principal Molagavita', 'idMunicipio' => 8],

            ['nombre' => 'Cancha San Andrés', 'idMunicipio' => 9],

            ['nombre' => 'Polideportivo San José', 'idMunicipio' => 10],

            ['nombre' => 'Cancha de Fútbol San Miguel', 'idMunicipio' => 11],

             ['nombre' => 'Cancha Principal Capitanejo', 'idMunicipio' => 12],

            
        ];

        DB::table('canchas')->insert($canchas);
    }
}
