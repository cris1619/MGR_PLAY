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
        Schema::create('partido_equipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_partido');
            $table->unsignedBigInteger('id_equipo');
            $table->enum('rol', ['Local','Visitante']);
            $table->integer('goles')->default(0);
            $table->foreign('id_partido')->references('id')->on('partido');
            $table->foreign('id_equipo')->references('id')->on('equipos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partido_equipos');
    }
};
