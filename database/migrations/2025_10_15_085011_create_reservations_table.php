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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            // Adresse de livraison
            $table->string('nom')->nullable();
            $table->string('telephone')->nullable();
            $table->string('adresse')->nullable(); // adresse détaillée ou quartier
            $table->string('ville')->nullable();
            $table->string('commune')->nullable();
            // Totaux financiers
            $table->foreignId('produit_id')->nullable()->constrained('produits')->onUpdate('cascade')->onDelete('cascade');
            $table->double('prix_unitaire')->default(0);
            $table->double('sous_total')->default(0);
            $table->double('frais_livraison')->default(0);
            $table->double('total')->default(0);
            $table->timestamp('date_reservation')->nullable();
            $table->longText('commentaire')->nullable();
            // Statuts
            $table->enum('statut', ['en_attente', 'en_cours', 'livrée', 'annulée'])
                ->default('en_attente');
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
