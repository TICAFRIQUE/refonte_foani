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
        Schema::table('point_ventes', function (Blueprint $table) {
            //
            $table->foreignId('ville_id')->nullable()->constrained('villes')->onUpdate('cascade')->onDelete('cascade'); // clé étrangère vers villes

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('point_ventes', function (Blueprint $table) {
            //
            $table->dropForeign(['ville_id']);
            $table->dropColumn('ville_id');
        });
    }
};
