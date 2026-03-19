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
        Schema::create('crews', function (Blueprint $table) {
            $table->id('id_crew_member');
            $table->foreignId('id_airlines')->constrained(table: 'airlines', column: 'id_airlines')->onDelete('cascade');
            $table->string('name');
            $table->boolean('available')->default(true);
            $table->string('nickname')->nullable();
            $table->string('post');
            $table->string('license_number')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crews');
    }
};
