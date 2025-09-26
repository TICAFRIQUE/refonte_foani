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
        Schema::create('page_pages', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('mot_cle')->nullable();
            $table->foreignId('id_categorie_page')->constrained('categorie_pages')->cascadeOnDelete();
            $table->boolean('visibilite')->default(true); // true = visible, false = cachée
            $table->string('image')->nullable();
            $table->longText('contenu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_pages');
    }
};
