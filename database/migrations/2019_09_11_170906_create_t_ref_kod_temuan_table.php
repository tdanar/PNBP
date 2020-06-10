<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTRefKodTemuanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_ref_kod_temuan', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('Id_up')->nullable();
			$table->string('Kode', 3)->nullable();
			$table->string('Deskripsi')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t_ref_kod_temuan');
	}

}
