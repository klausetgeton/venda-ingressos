<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngressosVendidos1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingressos_vendidos', function (Blueprint $table) {
            $table->integer('lotes_id')->index();
            $table->foreign('lotes_id')->references('id')->on('lotes');
            $table->date('data_pagamento')->nullable();
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
