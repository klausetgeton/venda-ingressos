<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModalidadesLoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modalidades_lote', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao', 150)->nullable();
            $table->double('valor', 5,2);
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
        Schema::drop('modalidades_lote');
    }
}
