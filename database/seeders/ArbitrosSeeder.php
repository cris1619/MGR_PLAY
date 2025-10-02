<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArbitrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arbitros = [
            ['nombre' => 'Carlos', 'apellido' => 'Velasco'],
            ['nombre' => 'María', 'apellido' => 'Sánchez'],
            ['nombre' => 'Juan', 'apellido' => 'Osorio'],
            ['nombre' => 'Andrea', 'apellido' => 'Pérez'],
            ['nombre' => 'Ricardo', 'apellido' => 'Gómez'],
            ['nombre' => 'Laura', 'apellido' => 'Torres'],
            ['nombre' => 'Felipe', 'apellido' => 'Rojas'],
        ];

        // Inserta los datos en la tabla 'arbitros'
        DB::table('arbitros')->insert($arbitros);
    }
}
