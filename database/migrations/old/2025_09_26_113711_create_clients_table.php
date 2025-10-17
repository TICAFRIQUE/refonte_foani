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
        Schema::create('clients', function (Blueprint $table) {

            $table->id();
            $table->string('nom');
            $table->string('prenoms');
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('ed_commune'); 
            $table->date('date_inscription')->nullable();
            $table->string('mot_de_passe'); 
            $table->string('quartier')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
