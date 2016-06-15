<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterIngressosVendidos2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingressos_vendidos', function (Blueprint $table) {
            $table->double('valor', '10.2');
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
            Schema::drop('valor');
        });
    }
}
