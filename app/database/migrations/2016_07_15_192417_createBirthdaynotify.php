<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBirthdaynotify extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notificationBirthDay', function($table)
		{
			# code...
			$table->increments('id');
			$table->integer('celebrant')->unsigned();
			$table->foreign('celebrant')->references('id')->on('users');
			$table->string('date');
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
		Schema::drop('notificationBirthDay');
	}

}
