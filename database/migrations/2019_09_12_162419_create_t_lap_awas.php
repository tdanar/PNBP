<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTLapAwas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_lap_awas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tahun');
            $table->string('no_lap');
            $table->date('tanggal');
            $table->string('nama_giat_was');
            $table->smallInteger('thn_mulai');
            $table->smallInteger('thn_usai');
            $table->integer('id_jenis_was');
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
        Schema::dropIfExists('t_lap_awas');
    }
}
