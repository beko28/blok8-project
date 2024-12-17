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
        Schema::table('poules', function (Blueprint $table) {
            $table->integer('max_teams')->default(12);
        });
    }
    
    public function down()
    {
        Schema::table('poules', function (Blueprint $table) {
            $table->dropColumn('max_teams');
        });
    }
    
};
