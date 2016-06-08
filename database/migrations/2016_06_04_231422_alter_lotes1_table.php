<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLotes1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lotes', function (Blueprint $table) {
            $table->integer('eventos_id')->index()->nullable();            
            $table->foreign('eventos_id')->references('id')->on('eventos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lotes', function (Blueprint $table) {
            //
        });
    }
}
