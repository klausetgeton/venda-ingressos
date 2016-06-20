<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPossibilidadesCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('possibilidades_compra', function (Blueprint $table) {           

            $table->integer('locais_id')->unsigned()->index();                   
            $table->foreign('locais_id')->references('id')->on('locais');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('possibilidades_compra', function (Blueprint $table) {
            //
        });
    }
}
