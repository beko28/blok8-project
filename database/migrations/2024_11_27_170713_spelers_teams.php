<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('spelers_teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('speler_id');
            $table->unsignedBigInteger('team_id');
            $table->enum('status', ['uitgenodigd', 'aangevraagd', 'geaccepteerd', 'geweigerd'])->default('uitgenodigd');
            $table->timestamps();

            $table->foreign('speler_id')->references('id')->on('spelers')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spelers_teams');
    }
};
