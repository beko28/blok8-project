<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerichtenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berichten', function (Blueprint $table) {
            $table->id(); // Primaire sleutel
            $table->unsignedBigInteger('ontvanger_id'); // De speler die het bericht ontvangt
            $table->unsignedBigInteger('verzender_id'); // De eigenaar die het bericht verzendt
            $table->text('inhoud'); // Inhoud van het bericht
            $table->timestamps(); // Timestamps voor created_at en updated_at

            // Buitenlandse sleutels
            $table->foreign('ontvanger_id')->references('id')->on('spelers')->onDelete('cascade');
            $table->foreign('verzender_id')->references('id')->on('spelers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berichten');
    }
}
