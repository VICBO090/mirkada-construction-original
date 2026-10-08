<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visites', function (Blueprint $table) {
            $table->id();
            $table->string('chemin');
            $table->date('jour');
            $table->unsignedInteger('total')->default(1);
            $table->timestamps();
            $table->unique(['chemin', 'jour']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visites');
    }
};
