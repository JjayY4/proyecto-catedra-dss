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
        Schema::create('reserves', function (Blueprint $table) {
            $table->id('id_reserves');
            $table->foreignId('id_passengers')->constrained(table: 'passengers', column: 'id_passengers')->onDelete('cascade');
            $table->foreignId('id_flights')->constrained(table: 'flights', column: 'id_flights')->onDelete('cascade');
            $table->foreignId('id_seats')->constrained(table: 'seats', column: 'id_seats')->onDelete('cascade');
            $table->string('state_reserve')->default('Pendiente');
            $table->string('reserve_code')->unique();
            $table->decimal('total_price', 8, 2);
            $table->dateTime('date_reserve');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserves');
    }
};
