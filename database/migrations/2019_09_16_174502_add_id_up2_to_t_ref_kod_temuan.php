<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdUp2ToTRefKodTemuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_ref_kod_temuan', function (Blueprint $table) {
            $table->integer('id_up2')->after('id_up');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_ref_kod_temuan', function (Blueprint $table) {
            $table->dropColumn('id_up2');
        });
    }
}
