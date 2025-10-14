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
        Schema::create('commande_produit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->nullable()->constrained('commandes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('produit_id')->nullable()->constrained('produits')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quantite')->default(1);
            $table->double('prix_unitaire');
            $table->double('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_produit');
    }
};
