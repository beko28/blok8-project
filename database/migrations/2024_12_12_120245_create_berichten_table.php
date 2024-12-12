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
        Schema::create('berichten', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('afzender_id');
            $table->unsignedBigInteger('ontvanger_id');
            $table->text('inhoud');
            $table->timestamps();
            
            // Verondersteld dat 'spelers' tabel bestaat
            $table->foreign('afzender_id')->references('id')->on('spelers')->onDelete('cascade');
            $table->foreign('ontvanger_id')->references('id')->on('spelers')->onDelete('cascade');
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berichten');
    }
};
