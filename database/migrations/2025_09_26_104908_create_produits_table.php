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
            $table->string('titre');

            // Clé étrangère vers categories
            $table->foreignId('id_categorie')
                ->constrained('categories')
                ->onDelete('cascade');

            $table->decimal('prix_de_vente', 10, 2)->nullable();
            $table->decimal('frais_de_port', 10, 2)->default(0);

            // Clé étrangère vers appreciations
            $table->foreignId('id_appreciation')
                ->constrained('appreciations')
                ->onDelete('cascade');

            $table->integer('stock')->default(0);
            $table->text('description')->nullable();
            $table->string('photo_de_couverture')->nullable();
            $table->string('galerie')->nullable(); // pour stocker plusieurs images
            $table->string('mots_cle')->nullable();
            $table->decimal('prix_achat', 10, 2)->nullable();
            $table->integer('reduction_en_pourcentage')->default(0);
            $table->boolean('visibilite')->default(true); // true = public, false = privé
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
