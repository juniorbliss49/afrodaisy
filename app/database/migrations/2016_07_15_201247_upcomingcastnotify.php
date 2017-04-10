<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Upcomingcastnotify extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifyUpcomingcast', function($table)
		{
			$table->increments('id');
			$table->integer('cast_id')->unsigned();
			$table->foreign('cast_id')->references('id')->on('casting');
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
		Schema::drop('notifyUpcomingcast');
	}

}
