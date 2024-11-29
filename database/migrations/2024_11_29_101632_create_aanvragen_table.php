<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAanvragenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aanvragen', function (Blueprint $table) {
            $table->id(); // Primaire sleutel
            $table->unsignedBigInteger('speler_id'); // De speler die de aanvraag doet
            $table->unsignedBigInteger('team_id'); // Het team waarvoor de aanvraag is
            $table->timestamps(); // Timestamps voor created_at en updated_at

            // Buitenlandse sleutels
            $table->foreign('speler_id')->references('id')->on('spelers')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aanvragen');
    }
}
