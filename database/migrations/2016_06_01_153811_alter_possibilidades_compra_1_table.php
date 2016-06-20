<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPossibilidadesCompra1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('possibilidades_compra', function (Blueprint $table) {
            $table->string('nome', '10');
            $table->boolean('disponivel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('possibilidades_compra', function (Blueprint $table) {
            //
        });
    }
}
