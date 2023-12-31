<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * //up sta treba da se izvrsi kada se ova migracija pokrene
     * //u ovom slucaju kreiramo tabelu tako da bi down bilo drop column
     */
    public function up(): void
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name_en', 255)->nullable(false)->unique();
            $table->string('name_sr', 255)->nullable(true)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * //down sta treba da se izvrsi kada se vratimo korak unazad
     * 
     */
    public function down(): void
    {
        Schema::dropIfExists('genres');
    }
};
