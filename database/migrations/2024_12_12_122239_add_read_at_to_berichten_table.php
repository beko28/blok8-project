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
        Schema::table('berichten', function (Blueprint $table) {
            $table->timestamp('read_at')->nullable()->after('inhoud');
        });
    }
    
    public function down()
    {
        Schema::table('berichten', function (Blueprint $table) {
            $table->dropColumn('read_at');
        });
    }
    
};
