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
        Schema::create('claims', function (Blueprint $table) {
            $table->id('id_claims');
            $table->foreignId('id_reserves')->constrained(table: 'reserves', column: 'id_reserves')->onDelete('cascade');
            $table->string('title');
            $table->string('type');
            $table->text('description');
            $table->dateTime('creation_date');
            $table->string('state')->default('Abierto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
