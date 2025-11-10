<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('idTorneo'); // <--- agregar aquí
            $table->timestamps();

            $table->foreign('idTorneo')
                ->references('id')
                ->on('torneos')
                ->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->dropForeign(['idTorneo']);
            $table->dropColumn('idTorneo');
        });
    }
};
