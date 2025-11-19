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
        Schema::table('partidos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_cancha')->nullable()->after('id_municipio');
            $table->unsignedBigInteger('id_arbitro')->nullable()->after('id_cancha');
            
            $table->foreign('id_cancha')->references('id')->on('canchas')->nullOnDelete();
            $table->foreign('id_arbitro')->references('id')->on('arbitros')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partidos', function (Blueprint $table) {
            $table->dropForeignKey(['id_cancha']);
            $table->dropForeignKey(['id_arbitro']);
            $table->dropColumn(['id_cancha', 'id_arbitro']);
        });
    }
};
