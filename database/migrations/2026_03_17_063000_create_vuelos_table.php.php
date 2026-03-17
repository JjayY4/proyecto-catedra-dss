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
        Schema::create('vuelos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aerolinea_id')->constrained('aerolineas')->onDelete('cascade');
            $table->foreignId('avion_id')->constrained('avions')->onDelete('cascade');
            
            $table->string('origen');
            $table->string('destino');
            $table->dateTime('fecha_salida');
            $table->decimal('tarifa', 8, 2);
            $table->string('estado')->default('Programado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vuelos');
    }
};
