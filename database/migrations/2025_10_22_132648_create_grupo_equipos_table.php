<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grupo_equipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idGrupo');
            $table->unsignedBigInteger('idEquipo');

            // Llaves foráneas
            $table->foreign('idGrupo')
                ->references('id')->on('grupos')
                ->onDelete('cascade');

            $table->foreign('idEquipo')
                ->references('id')->on('equipos')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grupo_equipos');
    }
};
