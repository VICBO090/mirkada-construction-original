<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('devis', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->string('type_projet');
            $table->string('budget_estimatif')->nullable();
            $table->text('description');
            $table->json('fichiers')->nullable();
            $table->enum('statut', ['nouveau', 'en_cours', 'traite'])->default('nouveau');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devis');
    }
};