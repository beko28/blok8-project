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
        Schema::create('spelers', function (Blueprint $table) {
            $table->id(); // Automatisch incrementerende primary key
            $table->string('naam')->nullable(); // Naam van de speler
            $table->string('achternaam')->nullable(); // Naam van de speler
            $table->string('email')->unique(); // Uniek emailadres
            $table->integer('leeftijd')->nullable(); // Rugnummer (optioneel)
            $table->integer('rugnummer')->nullable(); // Rugnummer (optioneel)
            $table->string('positie')->nullable(); // Positie op het veld (optioneel)
            $table->timestamps(); // Aangemaakt en bijgewerkt tijdstempels
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spelers');
    }
};
