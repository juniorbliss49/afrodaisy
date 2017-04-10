<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createcastmodelscancel extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('castmodelcancel', function($table)
		{
			$table->increments('id');
			$table->string('user_id');
			$table->string('cast_id');
			$table->text('msg');
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
		Schema::drop('castmodelcancel');
	}

}
