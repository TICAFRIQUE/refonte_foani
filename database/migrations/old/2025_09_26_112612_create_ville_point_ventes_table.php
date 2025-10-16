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
        Schema::create('ville_point_ventes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ville')->constrained('villes')->cascadeOnDelete();
            $table->foreignId('id_commune')->constrained('communes')->cascadeOnDelete();
            $table->string('contact')->nullable();
            $table->string('responsable')->nullable();
            $table->string('quartier')->nullable();
            $table->string('email')->nullable();
            $table->string('google_map')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ville_point_ventes');
    }
};
