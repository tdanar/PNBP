<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTLapAwasTemuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_lap_awas_temuan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul');
            $table->integer('id_kod_temuan');
            $table->string('kondisi');
            $table->integer('id_mata_uang');
            $table->decimal('nilai_uang');
            $table->string('lokasi');
            $table->integer('id_kod_sebab');
            $table->string('sebab');
            $table->string('akibat');
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
        Schema::dropIfExists('t_lap_awas_temuan');
    }
}
