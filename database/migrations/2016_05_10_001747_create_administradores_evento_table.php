<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministradoresEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administradores_evento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned()->index();
            $table->foreign('users_id')->references('id')->on('users');
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
        Schema::table('administradores_evento', function (Blueprint $table) {
            //
        });
    }
}
