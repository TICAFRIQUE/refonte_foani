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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            // Client lié à la commande
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');

            // Code unique pour identifier la commande (utile pour le suivi)
            $table->string('code')->unique();

            // Totaux financiers
            $table->integer('sous_total')->default(0);
            $table->integer('frais_livraison')->default(0);
            $table->integer('total')->default(0);

            // Adresse de livraison
            $table->string('nom')->nullable();
            $table->string('telephone')->nullable();
            $table->string('adresse')->nullable(); // adresse détaillée ou quartier
            $table->string('ville')->nullable();
            $table->string('commune')->nullable();

            // Statuts
            $table->enum('statut', ['en_attente', 'en_cours', 'livrée', 'annulée'])
                ->default('en_attente');

            // Mode de paiement
            $table->enum('mode_paiement', ['espece', 'cash', 'mobile_money', 'carte'])
                ->default('espece');
            // Date de la commande
            $table->timestamp('date_commande')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
