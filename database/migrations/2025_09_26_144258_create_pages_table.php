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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('libelle')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('mot_cle')->nullable();
            $table->foreignId('categorie_page_id')->nullable()->constrained('categorie_pages')->onUpdate('cascade')->onDelete('cascade'); // clé étrangère vers categorie_pages
            $table->boolean('statut')->default(true); // true = visible, false = cachée
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
