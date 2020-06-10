<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdLapToTLapAwasTemuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_lap_awas_temuan', function (Blueprint $table) {
            $table->integer('id_lap')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_lap_awas_temuan', function (Blueprint $table) {
            $table->dropColumn('id_lap');
        });
    }
}
