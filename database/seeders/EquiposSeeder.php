<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $municipioIds = [1, 2, 4, 6, 7, 9, 10, 11, 12, 13, 14, 15];
        $municipioNombres = [
            1 => 'Málaga', 
            2 => 'Concepción', 
            3 => 'Carcasí', 
            4 => 'Cerrito', 
            5 => 'Enciso', 
            6 => 'Guaca', 
            7 => 'Macaravita', 
            8 => 'Molagavita', 
            9 => 'San Andrés', 
            10 => 'San José de Miranda', 
            11 => 'San Miguel', 
            12 => 'Capitanejo'
        ];
        
        $equipos = [];
        $entrenadores = ['Javier', 'Luisa', 'Pedro', 'Gloria', 'Mario', 'Rosa', 'Marta', 'Andrés', 'Julián', 'Sofía', 'Héctor', 'Carmen', 'Luis', 'Diana', 'Roberto', 'Fernando', 'Elena', 'Carlos', 'María', 'Juan'];
        $estados = ['activo', 'inactivo'];

        // Generamos 8 equipos por cada municipio
        foreach ($municipioIds as $id) {
            $nombreMunicipio = $municipioNombres[$id];
            
            for ($i = 1; $i <= 8; $i++) {
                // Selecciona un entrenador y un estado al azar
                $entrenador = $entrenadores[array_rand($entrenadores)] . ' ' . ['Pérez', 'Gómez', 'Rojas', 'Díaz', 'Castro', 'Soto'][array_rand(['Pérez', 'Gómez', 'Rojas', 'Díaz', 'Castro', 'Soto'])];
                $estado = $estados[array_rand($estados)];

                $equipos[] = [
                    'nombre' => "{$nombreMunicipio} Equipo {$i}", 
                    'escudo' => "escudo_{$id}_equipo_{$i}.png", 
                    'entrenador' => $entrenador, 
                    'estado' => $estado, 
                    'idMunicipio' => $id
                ];
            }
        }

        // Inserta los datos en la tabla 'equipos'
        DB::table('equipos')->insert($equipos);
    }
}
