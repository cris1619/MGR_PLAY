<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JugadoresSeeder extends Seeder
{
    public function run(): void
    {
        $jugadores = [
            // Brasil
            ['nombre' => 'Neymar',       'apellido' => 'da Silva Santos Júnior', 'posicion' => 'Delantero', 'fechaNacimiento' => '1992-02-05', 'altura' => 1.75, 'peso' => 68, 'idEquipo' => 1],
            ['nombre' => 'Alisson',      'apellido' => 'Becker',                'posicion' => 'Portero',   'fechaNacimiento' => '1992-10-02', 'altura' => 1.91, 'peso' => 91, 'idEquipo' => 1],
            ['nombre' => 'Thiago',       'apellido' => 'Silva',                  'posicion' => 'Defensa',   'fechaNacimiento' => '1984-09-22', 'altura' => 1.83, 'peso' => 82, 'idEquipo' => 1],

            // México
            ['nombre' => 'Hirving',      'apellido' => 'Lozano',                 'posicion' => 'Delantero', 'fechaNacimiento' => '1995-07-30', 'altura' => 1.75, 'peso' => 70, 'idEquipo' => 2],
            ['nombre' => 'Guillermo',    'apellido' => 'Ochoa',                  'posicion' => 'Portero',   'fechaNacimiento' => '1985-07-13', 'altura' => 1.85, 'peso' => 80, 'idEquipo' => 2],
            ['nombre' => 'Héctor',       'apellido' => 'Herrera',                'posicion' => 'Centrocampista', 'fechaNacimiento' => '1990-04-19', 'altura' => 1.78, 'peso' => 72, 'idEquipo' => 2],

            // Países Bajos
            ['nombre' => 'Virgil',       'apellido' => 'van Dijk',               'posicion' => 'Defensa',   'fechaNacimiento' => '1991-07-08', 'altura' => 1.93, 'peso' => 92, 'idEquipo' => 3],
            ['nombre' => 'Memphis',      'apellido' => 'Depay',                  'posicion' => 'Delantero', 'fechaNacimiento' => '1994-02-13', 'altura' => 1.76, 'peso' => 74, 'idEquipo' => 3],
            ['nombre' => 'Frenkie',      'apellido' => 'de Jong',                'posicion' => 'Centrocampista', 'fechaNacimiento' => '1997-05-12', 'altura' => 1.80, 'peso' => 74, 'idEquipo' => 3],

            // Chile
            ['nombre' => 'Alexis',       'apellido' => 'Sánchez',               'posicion' => 'Delantero', 'fechaNacimiento' => '1988-12-19', 'altura' => 1.69, 'peso' => 69, 'idEquipo' => 4],
            ['nombre' => 'Claudio',      'apellido' => 'Bravo',                 'posicion' => 'Portero',   'fechaNacimiento' => '1983-04-13', 'altura' => 1.85, 'peso' => 82, 'idEquipo' => 4],
            ['nombre' => 'Arturo',       'apellido' => 'Vidal',                 'posicion' => 'Centrocampista', 'fechaNacimiento' => '1987-05-22', 'altura' => 1.80, 'peso' => 78, 'idEquipo' => 4],

            // Colombia
            ['nombre' => 'James',        'apellido' => 'Rodríguez',            'posicion' => 'Centrocampista', 'fechaNacimiento' => '1991-07-12', 'altura' => 1.80, 'peso' => 78, 'idEquipo' => 5],
            ['nombre' => 'David',        'apellido' => 'Ospina',               'posicion' => 'Portero',   'fechaNacimiento' => '1988-08-31', 'altura' => 1.83, 'peso' => 80, 'idEquipo' => 5],
            ['nombre' => 'Radamel',      'apellido' => 'Falcao',               'posicion' => 'Delantero', 'fechaNacimiento' => '1986-02-10', 'altura' => 1.77, 'peso' => 78, 'idEquipo' => 5],

            // Grecia
            ['nombre' => 'Giorgos',      'apellido' => 'Tzavellas',            'posicion' => 'Defensa',   'fechaNacimiento' => '1987-12-26', 'altura' => 1.86, 'peso' => 79, 'idEquipo' => 6],
            ['nombre' => 'Sokratis',     'apellido' => 'Papastathopoulos',     'posicion' => 'Defensa',   'fechaNacimiento' => '1988-06-09', 'altura' => 1.92, 'peso' => 90, 'idEquipo' => 6],
            ['nombre' => 'Giorgos',      'apellido' => 'Karagounis',           'posicion' => 'Centrocampista', 'fechaNacimiento' => '1977-03-06', 'altura' => 1.76, 'peso' => 74, 'idEquipo' => 6],

            // Costa Rica
            ['nombre' => 'Keylor',       'apellido' => 'Navas',                'posicion' => 'Portero',   'fechaNacimiento' => '1986-12-15', 'altura' => 1.85, 'peso' => 82, 'idEquipo' => 7],
            ['nombre' => 'Bryan',        'apellido' => 'Ruiz',                 'posicion' => 'Centrocampista', 'fechaNacimiento' => '1985-08-18', 'altura' => 1.82, 'peso' => 76, 'idEquipo' => 7],
            ['nombre' => 'Joel',         'apellido' => 'Campbell',             'posicion' => 'Delantero', 'fechaNacimiento' => '1992-06-26', 'altura' => 1.79, 'peso' => 74, 'idEquipo' => 7],

            // Uruguay
            ['nombre' => 'Luis',         'apellido' => 'Suárez',               'posicion' => 'Delantero', 'fechaNacimiento' => '1987-01-24', 'altura' => 1.82, 'peso' => 86, 'idEquipo' => 8],
            ['nombre' => 'Edinson',      'apellido' => 'Cavani',               'posicion' => 'Delantero', 'fechaNacimiento' => '1987-02-14', 'altura' => 1.84, 'peso' => 78, 'idEquipo' => 8],
            ['nombre' => 'Fernando',     'apellido' => 'Muslera',              'posicion' => 'Portero',   'fechaNacimiento' => '1986-06-16', 'altura' => 1.90, 'peso' => 87, 'idEquipo' => 8],

            // Francia
            ['nombre' => 'Kylian',       'apellido' => 'Mbappé',               'posicion' => 'Delantero', 'fechaNacimiento' => '1998-12-20', 'altura' => 1.78, 'peso' => 73, 'idEquipo' => 9],
            ['nombre' => 'Hugo',         'apellido' => 'Lloris',               'posicion' => 'Portero',   'fechaNacimiento' => '1986-12-26', 'altura' => 1.88, 'peso' => 86, 'idEquipo' => 9],
            ['nombre' => 'Paul',         'apellido' => 'Pogba',                'posicion' => 'Centrocampista', 'fechaNacimiento' => '1993-03-15', 'altura' => 1.91, 'peso' => 84, 'idEquipo' => 9],

            // Suiza
            ['nombre' => 'Xherdan',      'apellido' => 'Shaqiri',              'posicion' => 'Centrocampista', 'fechaNacimiento' => '1991-10-10', 'altura' => 1.69, 'peso' => 75, 'idEquipo' => 10],
            ['nombre' => 'Yann',         'apellido' => 'Sommer',               'posicion' => 'Portero',   'fechaNacimiento' => '1988-12-17', 'altura' => 1.83, 'peso' => 82, 'idEquipo' => 10],
            ['nombre' => 'Granit',       'apellido' => 'Xhaka',                'posicion' => 'Centrocampista', 'fechaNacimiento' => '1992-09-27', 'altura' => 1.85, 'peso' => 82, 'idEquipo' => 10],

            // Argentina
            ['nombre' => 'Lionel',       'apellido' => 'Messi',                'posicion' => 'Delantero', 'fechaNacimiento' => '1987-06-24', 'altura' => 1.70, 'peso' => 72, 'idEquipo' => 11],
            ['nombre' => 'Sergio',       'apellido' => 'Agüero',               'posicion' => 'Delantero', 'fechaNacimiento' => '1988-06-02', 'altura' => 1.73, 'peso' => 70, 'idEquipo' => 11],
            ['nombre' => 'Emiliano',     'apellido' => 'Martínez',             'posicion' => 'Portero',   'fechaNacimiento' => '1992-09-02', 'altura' => 1.95, 'peso' => 92, 'idEquipo' => 11],

            // Nigeria
            ['nombre' => 'Victor',       'apellido' => 'Moses',                'posicion' => 'Centrocampista', 'fechaNacimiento' => '1990-12-12', 'altura' => 1.76, 'peso' => 77, 'idEquipo' => 12],
            ['nombre' => 'Ahmed',        'apellido' => 'Musa',                 'posicion' => 'Delantero', 'fechaNacimiento' => '1992-10-14', 'altura' => 1.70, 'peso' => 70, 'idEquipo' => 12],
            ['nombre' => 'Carl',         'apellido' => 'Ikeme',                'posicion' => 'Portero',   'fechaNacimiento' => '1986-05-08', 'altura' => 1.85, 'peso' => 80, 'idEquipo' => 12],

            // Alemania
            ['nombre' => 'Manuel',       'apellido' => 'Neuer',                'posicion' => 'Portero',   'fechaNacimiento' => '1986-03-27', 'altura' => 1.93, 'peso' => 92, 'idEquipo' => 13],
            ['nombre' => 'Thomas',       'apellido' => 'Müller',               'posicion' => 'Delantero', 'fechaNacimiento' => '1989-09-13', 'altura' => 1.86, 'peso' => 76, 'idEquipo' => 13],
            ['nombre' => 'Toni',         'apellido' => 'Kroos',                'posicion' => 'Centrocampista', 'fechaNacimiento' => '1990-01-04', 'altura' => 1.83, 'peso' => 78, 'idEquipo' => 13],

            // Estados Unidos
            ['nombre' => 'Christian',    'apellido' => 'Pulisic',              'posicion' => 'Delantero', 'fechaNacimiento' => '1998-09-18', 'altura' => 1.73, 'peso' => 67, 'idEquipo' => 14],
            ['nombre' => 'Zack',         'apellido' => 'Steffen',              'posicion' => 'Portero',   'fechaNacimiento' => '1995-04-02', 'altura' => 1.85, 'peso' => 82, 'idEquipo' => 14],
            ['nombre' => 'Weston',       'apellido' => 'McKennie',             'posicion' => 'Centrocampista', 'fechaNacimiento' => '1998-08-28', 'altura' => 1.83, 'peso' => 80, 'idEquipo' => 14],

            // Bélgica
            ['nombre' => 'Eden',         'apellido' => 'Hazard',               'posicion' => 'Delantero', 'fechaNacimiento' => '1991-01-07', 'altura' => 1.75, 'peso' => 74, 'idEquipo' => 15],
            ['nombre' => 'Thibaut',      'apellido' => 'Courtois',             'posicion' => 'Portero',   'fechaNacimiento' => '1992-05-11', 'altura' => 1.99, 'peso' => 96, 'idEquipo' => 15],
            ['nombre' => 'Kevin',        'apellido' => 'De Bruyne',            'posicion' => 'Centrocampista', 'fechaNacimiento' => '1991-06-28', 'altura' => 1.81, 'peso' => 68, 'idEquipo' => 15],

            // Argelia
            ['nombre' => 'Riyad',        'apellido' => 'Mahrez',               'posicion' => 'Delantero', 'fechaNacimiento' => '1991-02-21', 'altura' => 1.79, 'peso' => 67, 'idEquipo' => 16],
            ['nombre' => 'Ras',         'apellido' => 'MBolhi',              'posicion' => 'Portero',   'fechaNacimiento' => '1986-04-25', 'altura' => 1.90, 'peso' => 87, 'idEquipo' => 16],
            ['nombre' => 'Islam',        'apellido' => 'Slimani',              'posicion' => 'Delantero', 'fechaNacimiento' => '1988-06-18', 'altura' => 1.87, 'peso' => 82, 'idEquipo' => 16],
        ];

        foreach ($jugadores as $jugador) {
            DB::table('jugadores')->insert(array_merge($jugador, [
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
