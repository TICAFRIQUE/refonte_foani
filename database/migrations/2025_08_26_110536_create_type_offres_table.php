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
        Schema::create('type_offres', function (Blueprint $table) {
            $table->id();
            $table->string('libelle')->nullable(); // Nom du type d'offre [ex: "Promotion", "Nouveau Produit", etc.]
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->boolean('statut')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_offres');
    }
};
