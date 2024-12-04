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
        Schema::create('spelers', function (Blueprint $table) {
            $table->id();
            $table->string('voornaam')->nullable();
            $table->string('achternaam')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['speler', 'eigenaar', 'admin']);
            $table->integer('leeftijd')->nullable();
            $table->integer('rugnummer')->nullable();
            $table->string('positie')->nullable();
            $table->timestamps();
        });
    }        

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spelers');
    }
};
