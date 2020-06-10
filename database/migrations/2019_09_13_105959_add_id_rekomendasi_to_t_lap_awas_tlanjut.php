<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdRekomendasiToTLapAwasTlanjut extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_lap_awas_tlanjut', function (Blueprint $table) {
            $table->integer('id_rekomendasi')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_lap_awas_tlanjut', function (Blueprint $table) {
            $table->dropColumn('id_rekomendasi');
        });
    }
}
