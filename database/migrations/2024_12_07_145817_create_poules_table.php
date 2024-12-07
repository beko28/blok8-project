<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoulesTable extends Migration
{
    public function up()
    {
        Schema::create('poules', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->unsignedBigInteger('competitie_id');
            $table->foreign('competitie_id')->references('id')->on('competities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('poules');
    }
}
