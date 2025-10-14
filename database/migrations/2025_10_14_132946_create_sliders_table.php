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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('libelle')->unique(); // titre ou nom du slider
            $table->string('url')->nullable(); // lien associé
            $table->string('btn_nom')->nullable(); // nom du bouton (ex: "Découvrir")
            $table->text('description')->nullable(); // texte descriptif
            $table->string('image')->nullable(); // chemin de l’image stockée
             $table->boolean('visible')->default(true); // cacher ou voir
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
