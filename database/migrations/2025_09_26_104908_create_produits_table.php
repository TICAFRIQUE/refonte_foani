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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable(); // Code unique du produit (SKU)
            $table->string('slug')->unique()->nullable();
            $table->string('libelle')->nullable();


            $table->integer('stock')->default(0);
            $table->longText('description')->nullable();
            $table->double('prix_achat', 10, 2)->nullable();
            $table->double('prix_de_vente', 10, 2)->nullable();
            $table->double('frais_de_port', 10, 2)->default(0);

            //PROMOTION
            $table->enum('type_reduction', ['montant', 'pourcentage'])->nullable();
            $table->double('valeur_reduction', 10, 2)->nullable();
            $table->date('date_debut_reduction')->nullable();
            $table->date('date_fin_reduction')->nullable();

            $table->boolean('visibilite')->default(true); // true = public, false = privé
            $table->boolean('statut')->default(true);




            // Clé étrangère vers categories
            $table->foreignId('categorie_id')
                ->constrained('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');



            // Clé étrangère vers type_offres
            $table->foreignId('type_offre_id')
                ->constrained('type_offres')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
