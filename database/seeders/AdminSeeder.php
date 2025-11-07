<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Admin::create([
            'nombre' => 'Aprendiz',
            'apellido' => 'Sena',
            'email' => 'senacata@example.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
