<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTLapAwasRekomend extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_lap_awas_rekomend', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_temuan');
            $table->string('rekomendasi');
            $table->integer('id_kod_rekomendasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_lap_awas_rekomend');
    }
}
