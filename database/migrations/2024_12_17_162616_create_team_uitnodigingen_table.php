<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('team_uitnodigingen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('poule_id');
            $table->unsignedBigInteger('team_id');
            $table->string('status')->default('pending');
            $table->timestamps();
    
            $table->foreign('poule_id')->references('id')->on('poules')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_uitnodigingen');
    }
};
