<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdStatusKirimToTLapAwas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_lap_awas', function (Blueprint $table) {
            $table->integer('id_status_kirim')->after('id_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_lap_awas', function (Blueprint $table) {
            $table->dropColumn('id_status_kirim');
        });
    }
}
