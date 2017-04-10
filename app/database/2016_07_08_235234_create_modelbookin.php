<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelbookin extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('modelbooking', function($table)
		{
			$table->increments('id');
			$table->integer('model_id')->unsigned();
			$table->foreign('model_id')->references('id')->on('users');
			$table->integer('booker')->unsigned();
			$table->foreign('booker')->references('id')->on('users');
			$table->string('bookingTitle');
			$table->string('bookingDesc');
			$table->string('cash');
			$table->string('jobdate');
			$table->string('enddate');
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
		Schema::drop('modelbooking');
	}

}
