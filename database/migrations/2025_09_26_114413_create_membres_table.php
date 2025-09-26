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
        Schema::create('membres', function (Blueprint $table) {
          $table->id();
            $table->string('nom_prenoms');
            $table->string('emails')->unique();
            $table->string('matricule')->unique();
            $table->string('photo')->nullable();
            $table->string('contact')->nullable();
            $table->string('mot_de_passe');
            $table->string('role')->default('admin'); // par exemple 'admin', 'commercial','livreur.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membres');
    }
};
