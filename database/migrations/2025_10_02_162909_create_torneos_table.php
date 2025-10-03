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
        $table->string('logo')->nullable();
        $table->integer('numeroEquipos');
        $table->enum('estado', ['activo', 'inactivo'])->default('activo');
        $table->enum('tipoDeporte', ['FUTBOL','FUTBOL-5','FUTBOL-8','MICRO-FUTBOL','OTRO'])->default('FUTBOL');
        $table->enum('formato', ['FASE_GRUPOS','LIGUILLA','ELIMINACION_DIRECTA','MIXTO'])->default('FASE_GRUPOS');
        $table->date('fechaInicio');
        $table->date('fechaFin');
        $table->text('reglas')->nullable();
        $table->decimal('premio', 10, 2)->nullable();
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
