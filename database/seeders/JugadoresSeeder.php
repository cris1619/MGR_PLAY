<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JugadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Obtener los IDs de todos los equipos creados previamente (los 96)
        $equipoIds = DB::table('equipos')->pluck('id');
        
        if ($equipoIds->isEmpty()) {
            echo "Aviso: No se encontraron equipos. Asegúrate de ejecutar el EquipoSeeder primero.\n";
            return;
        }

        $jugadores = [];
        $posiciones = ['Portero', 'Defensa Central', 'Lateral Derecho', 'Lateral Izquierdo', 'Mediocentro', 'Extremo Derecho', 'Extremo Izquierdo', 'Delantero'];
        $nombres = ['Carlos', 'Juan', 'Andrés', 'Felipe', 'Santiago', 'David', 'Camilo', 'Ricardo', 'Alejandro', 'Daniel', 'Valentina', 'Sofia', 'Isabella', 'Mariana', 'Laura'];
        $apellidos = ['Gómez', 'Rodríguez', 'López', 'Díaz', 'Martínez', 'Pérez', 'Sánchez', 'Ramírez', 'Torres', 'Castro'];
        $estados = ['activo', 'inactivo'];

        $jugadoresPorEquipo = 15; // Mínimo de 15 jugadores por equipo

        // 2. Iterar sobre cada ID de equipo para crear 15 jugadores
        foreach ($equipoIds as $idEquipo) {
            for ($i = 0; $i < $jugadoresPorEquipo; $i++) {
                
                // Generar datos aleatorios
                $nombre = $nombres[array_rand($nombres)];
                $apellido = $apellidos[array_rand($apellidos)];
                $posicion = $posiciones[array_rand($posiciones)];
                
                // Fecha de nacimiento: entre 18 y 35 años de antigüedad
                $fechaNacimiento = Carbon::now()->subYears(rand(18, 35))->subDays(rand(0, 365));
                
                // Altura (entre 1.65 y 1.95 metros) y Peso (entre 60.0 y 95.0 kg)
                $altura = rand(165, 195) / 100; // Divide por 100 para tener decimales
                $peso = rand(600, 950) / 10; // Divide por 10 para tener decimales

                $jugadores[] = [
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'posicion' => $posicion,
                    'fechaNacimiento' => $fechaNacimiento->format('Y-m-d'),
                    'altura' => number_format($altura, 2, '.', ''), // Formatear a 2 decimales
                    'peso' => number_format($peso, 2, '.', ''),
                    'estado' => $estados[array_rand($estados)],
                    'idEquipo' => $idEquipo,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        // 3. Insertar todos los jugadores en la base de datos
        DB::table('jugadores')->insert($jugadores);
    }
}
