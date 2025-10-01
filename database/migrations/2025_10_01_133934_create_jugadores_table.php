<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('posicion');
            $table->date('fechaNacimiento');
            $table->decimal('altura', 5, 2);
            $table->decimal('peso', 5, 2);
            $table->enum('estado', ['activo', 'inactivo']);
            $table->unsignedBigInteger('idEquipo');
            $table->foreign('idEquipo')->references('id')->on('equipos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadores');
    }
};
