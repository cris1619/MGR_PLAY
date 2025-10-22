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
        Schema::create('grupo_equipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idGrupo');
            $table->unsignedBigInteger('idEquipo');
            $table->foreign('idGrupo')->references('id')->on('grupos');
            $table->foreign('idEquipo')->references('id')->on('equipos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_equipos');
    }
};
