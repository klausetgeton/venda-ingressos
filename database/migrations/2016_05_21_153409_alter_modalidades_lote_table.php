<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterModalidadesLoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modalidades_lote', function (Blueprint $table) {

            $table->dropForeign(['eventos_id']);

            $table->dropColumn('eventos_id');

            $table->integer('lotes_id')->unsigned()->index();                   

            $table->foreign('lotes_id')->references('id')->on('lotes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('modalidades_lote', function (Blueprint $table) {
            //
        });
    }
}
