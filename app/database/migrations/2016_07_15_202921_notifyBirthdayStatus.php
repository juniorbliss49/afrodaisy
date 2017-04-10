<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotifyBirthdayStatus extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('NotifyBirthdayStatus', function($table)
		{
			$table->increments('id');
			$table->integer('Birthid')->unsigned();
			$table->foreign('Birthid')->references('id')->on('notificationBirthDay');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('NotifyBirthdayStatus');
	}

}
