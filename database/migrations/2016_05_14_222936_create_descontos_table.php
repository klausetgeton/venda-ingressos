<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescontosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descontos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao', 150)->nullable();
            $table->string('hash', 20)->unique();;   
            $table->double('porcentagem', 5,2);   
            $table->integer('quantidade');   
            $table->integer('lotes_id')->index()->nullable();            
            $table->integer('eventos_id')->index()->nullable();            
            $table->foreign('lotes_id')->references('id')->on('lotes');
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
        Schema::drop('descontos');
    }
}
