<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitiesTable extends Migration
{
    public function up()
    {
        Schema::create('competities', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->enum('type', ['beker', 'league']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('competities');
    }
}
