<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('municipios')->insert([
        ['nombre' => 'Málaga'],
        ['nombre' => 'Concepción'],
        ['nombre' => 'Carcasí'],
        ['nombre' => 'Cerrito'],
        ['nombre' => 'Enciso'],
        ['nombre' => 'Guaca'],
        ['nombre' => 'Macaravita'],
        ['nombre' => 'Molagavita'],
        ['nombre' => 'San Andrés'],
        ['nombre' => 'San José de Miranda'],
        ['nombre' => 'San Miguel'],
        ['nombre' => 'Capitanejo'],
    ]);
}
}
