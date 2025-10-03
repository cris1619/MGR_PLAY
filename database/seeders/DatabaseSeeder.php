<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MunicipiosSeeder::class,
        ]);

        $this->call([
            CanchasSeeder::class,
        ]);

        $this->call([
            ArbitrosSeeder::class,
        ]);

        $this->call([
            EquiposSeeder::class,
        ]);

        $this->call([
            JugadoresSeeder::class,
        ]);

        $this->call([
            TorneosSeeder::class,
        ]);
    }
}
