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
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_torneo');
            $table->foreign('id_torneo')->references('id')->on('torneos');
            $table->unsignedBigInteger('id_grupo')->nullable();
            $table->foreign('id_grupo')->references('id')->on('grupos');
            $table->string('fase')->nullable(); // "Grupos", "Cuartos", etc.
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->unsignedBigInteger('id_municipio')->nullable();
            $table->foreign('id_municipio')->references('id')->on('municipios');
            $table->boolean('jugado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
