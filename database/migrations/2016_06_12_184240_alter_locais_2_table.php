<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLocais2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locais', function (Blueprint $table) {
            $table->integer('capacidade');
            $table->string('endereco', 150);
            $table->string('cidade', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locais', function (Blueprint $table) {
            Schema::drop('capacidade');
            Schema::drop('endereco');
            Schema::drop('cidade');
        });
    }
}
