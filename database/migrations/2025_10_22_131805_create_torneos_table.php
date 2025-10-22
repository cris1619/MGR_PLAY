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
        Schema::create('torneos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idAdmin')->nullable();
            $table->foreign('idAdmin')->references('id')->on('admin');
            $table->unsignedBigInteger('idMunicipio')->nullable();
            $table->foreign('idMunicipio')->references('id')->on('municipios');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->enum('tipo', ['Grupos','Liguilla','Eliminacion'])->default('Grupos');
            $table->enum('estado', ['Pendiente','En curso','Finalizado'])->default('Pendiente');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->integer('num_equipos')->nullable();
            $table->integer('cantidad_grupos')->nullable();
            $table->integer('equipos_por_grupo')->nullable();
            $table->integer('clasificados_por_grupo')->nullable();
            $table->tinyInteger('partidos_por_enfrentamiento')->default(1); // 1 o 2
            $table->string('premio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torneos');
    }
};
