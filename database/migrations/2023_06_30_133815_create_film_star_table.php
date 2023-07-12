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
        Schema::create('film_star', function (Blueprint $table) {
            $table->unsignedBigInteger('film_id')->nullable(false)->unique();
            $table->unsignedBigInteger('person_id')->nullable(false)->unique();
            $table->primary(['film_id', 'person_id'], 'film_star_pk');
            $table->foreign('film_id', 'film_star_film_fk')->references('id')->on('films')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('person_id', 'film_star_person_fk')->references('id')->on('people')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_star');
    }
};
