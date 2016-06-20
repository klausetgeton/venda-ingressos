<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDescontosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('descontos', function (Blueprint $table) {
            $table->dropForeign(['lotes_id']);
            $table->dropColumn('lotes_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('descontos', function (Blueprint $table) {
            //
        });
    }
}
