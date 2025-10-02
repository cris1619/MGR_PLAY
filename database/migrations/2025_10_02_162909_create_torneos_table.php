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
            $table->unsignedBigInteger('idMunicipio');
            $table->foreign('idMunicipio')->references('id')->on('municipios');
            $table->string('nombre');
            $table->text('descripcion');
            $table->integer('numeroEquipos');
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->enum('tipoTorneo', ['FaseGrupos'])->default('FaseGrupos');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->text('reglas');
            $table->decimal('premio', 10, 2);
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
