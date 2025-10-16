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
        Schema::create('point_ventes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_point_vente_id')->nullable()->constrained('categorie_point_ventes')->onUpdate('cascade')->onDelete('cascade'); // 
            $table->foreignId('commune_id')->nullable()->constrained('communes')->onUpdate('cascade')->onDelete('cascade'); // clé étrangère vers communes
            $table->string('quartier')->nullable();
            $table->string('contact')->nullable();
            $table->string('autre_contact')->nullable();
            $table->string('responsable')->nullable();
            $table->string('email')->nullable();
            $table->string('google_map')->nullable();
            $table->boolean('statut')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_ventes');
    }
};
