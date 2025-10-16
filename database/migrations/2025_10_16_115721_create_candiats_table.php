<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécution de la migration.
     */
    public function up(): void
    {
        Schema::create('candidats', function (Blueprint $table) {
            $table->string('id', 10)->primary(); // ID généré manuellement
            $table->string('nom_prenom');
            $table->string('email')->unique();
            $table->string('objet')->nullable();
            $table->string('cv')->nullable(); // chemin du fichier CV
            $table->string('captcha')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Annulation de la migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidats');
    }
};
