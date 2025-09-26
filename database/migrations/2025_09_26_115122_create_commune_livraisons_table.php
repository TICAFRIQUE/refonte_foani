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
        Schema::create('commune_livraisons', function (Blueprint $table) {
            $table->id();
            $table->string('commune');
            $table->foreignId('id_ville_livraison')->constrained('ville_livraisons')->onDelete('cascade');
            $table->string('frais_de_port');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commune_livraisons');
    }
};
