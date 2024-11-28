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
        Schema::create('spelers_teams', function (Blueprint $table) {
            $table->id(); // Automatisch incrementerende primary key
            $table->unsignedBigInteger('speler_id'); // Verwijzing naar de speler
            $table->unsignedBigInteger('team_id'); // Verwijzing naar het team
            $table->enum('status', ['uitgenodigd', 'aangevraagd', 'geaccepteerd', 'geweigerd'])->default('uitgenodigd');
            $table->timestamps(); // Aangemaakt en bijgewerkt tijdstempels

            // Relaties
            $table->foreign('speler_id')->references('id')->on('spelers')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spelers_teams');
    }
};
