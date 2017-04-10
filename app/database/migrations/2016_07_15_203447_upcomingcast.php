<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Upcomingcast extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('NotifyUpcomingStatus', function($table)
		{
			$table->increments('id');
			$table->integer('upcomingId')->unsigned();
			$table->foreign('upcomingId')->references('id')->on('notifyUpcomingcast');
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
		Schema::drop('NotifyUpcomingStatus');
	}

}
