<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Castworkinghour extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Castworkinghour', function($table)
		{
			# code...
			$table->increments('id');
			$table->string('cast_id');
			$table->string('timefrom');
			$table->string('timeTo');
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
		//
		Schema::drop('Castworkinghour');
	}

}
