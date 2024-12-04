<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Teams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->string('adres');
            $table->integer('max_spelers');
            $table->foreignId('eigenaar_id')->constrained('spelers')->onDelete('cascade');
            $table->timestamps();        

            $table->foreign('eigenaar_id')->references('id')->on('spelers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
