<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notifyjob extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Notifyjob', function($table)
		{
			$table->increments('id');
			$table->string('Notid');
			$table->string('job_id');
			$table->string('user_id');
			$table->string('status');
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
		Schema::drop('Notifyjob');
	}

}
