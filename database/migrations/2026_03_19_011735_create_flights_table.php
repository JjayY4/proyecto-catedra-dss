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
        Schema::create('flights', function (Blueprint $table) {
            $table->id('id_flights');
            $table->foreignId('id_airplanes')->constrained(table: 'airplanes', column: 'id_airplanes')->onDelete('cascade');
            $table->foreignId('id_airlines')->constrained(table: 'airlines', column: 'id_airlines')->onDelete('cascade');
            $table->foreignId('id_routes')->constrained(table: 'routes', column: 'id_routes')->onDelete('cascade');
            $table->string('flight_number')->unique();
            $table->dateTime('departure_date_time');
            $table->dateTime('arrival_date_time');
            $table->decimal('base_rate', 8, 2);
            $table->string('state')->default('Programado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
