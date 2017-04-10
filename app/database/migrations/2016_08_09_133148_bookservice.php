<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bookservice extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('courses', function($table)
		{
			$table->increments('id');
			$table->string('user_id');
			$table->string('title');
			$table->string('duration');
			$table->text('description');
			$table->string('country');
			$table->string('location');
			$table->string('city');
			$table->string('time');
			$table->string('venue');
			$table->string('image');
			$table->string('price');
			$table->string('discount');
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
		Schema::drop('courses');
	}

}
