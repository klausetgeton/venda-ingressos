<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePossibilidadesEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('possibilidades_evento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('possibilidades_compra_id')->unsigned()->index();            
            $table->foreign('possibilidades_compra_id')->references('id')->on('possibilidades_compra');
            $table->integer('eventos_id')->unsigned()->index();            
            $table->foreign('eventos_id')->references('id')->on('eventos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('possibilidades_evento');
    }
}
