<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterIngressosVendidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingressos_vendidos', function (Blueprint $table) {

            $table->dropForeign(['possibilidades_evento_id']);
            $table->dropColumn('possibilidades_evento_id');

            $table->integer('possibilidades_compra_id')->unsigned()->index();                   
            $table->foreign('possibilidades_compra_id')->references('id')->on('possibilidades_compra');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingressos_vendidos', function (Blueprint $table) {
            //
        });
    }
}
