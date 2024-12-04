<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poules', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->unsignedBigInteger('eigenaar_id')->nullable(); // Optioneel veld
            $table->timestamps();

            // Foreign key linking eigenaar_id to spelers table
            $table->foreign('eigenaar_id')->references('id')->on('spelers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poules');
    }
}

