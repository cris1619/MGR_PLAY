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
        Schema::create('torneo_equipo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTorneo');
            $table->unsignedBigInteger('idEquipo');
            $table->foreign('idTorneo')->references('id')->on('torneos');
            $table->foreign('idEquipo')->references('id')->on('equipos');
            $table->string('grupo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torneo_equipo');
    }
};
