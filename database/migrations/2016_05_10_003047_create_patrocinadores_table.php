<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatrocinadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patrocinadores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 150);
            $table->string('descricao', 150)->nullable();
            $table->string('logo', 50)->nullable();
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
        Schema::table('patrocinadores', function (Blueprint $table) {
            //
        });
    }
}
