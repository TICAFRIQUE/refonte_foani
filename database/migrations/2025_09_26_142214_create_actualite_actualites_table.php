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
        Schema::create('actualite_actualites', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->boolean('visibilite')->default(1);
            $table->boolean('flash_info')->default(0);
            $table->string('mot_cle')->nullable();
            $table->string('image')->nullable(); // pour stocker le nom ou chemin du fichier
            $table->longText('contenu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actualite_actualites');
    }
};
