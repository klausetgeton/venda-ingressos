<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngressosVendidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingressos_vendidos', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('data_compra');
            $table->dateTime('data_cancelamento')->nullable();            
            $table->integer('users_id')->index()->unsigned();            
            $table->integer('descontos_id')->index()->nullable();            
            $table->integer('possibilidades_evento_id')->index()->nullable();            
            $table->foreign('descontos_id')->references('id')->on('descontos');
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('possibilidades_evento_id')->references('id')->on('possibilidades_evento');
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
        Schema::drop('ingressos_vendidos');
    }
}
