<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('entreprises', function (Blueprint $table) {
            $table->unsignedInteger('nb_projets_realises')->nullable()->after('valeurs');
            $table->unsignedInteger('annees_experience')->nullable()->after('nb_projets_realises');
        });
    }

    public function down(): void
    {
        Schema::table('entreprises', function (Blueprint $table) {
            $table->dropColumn(['nb_projets_realises', 'annees_experience']);
        });
    }
};
