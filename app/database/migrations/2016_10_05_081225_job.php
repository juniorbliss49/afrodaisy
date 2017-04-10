<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Job extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job', function($table)
		{
			$table->increments('id');
			$table->string('user_id');
			$table->string('title');
			$table->string('jobcode');
			$table->text('job_description');
			$table->text('job_task');
			$table->string('amount');
			$table->string('country');
			$table->string('location');
			$table->string('area');
			$table->text('venue');
			$table->string('jobDay');
			$table->string('jobMonth');
			$table->string('jobYear');
			$table->string('Yearend');
			$table->string('Monthend');
			$table->string('Dayend');
			$table->string('Dayexp');
			$table->string('monthexp');
			$table->string('yearexp');
			$table->string('status');
			$table->string('visibility');
			$table->string('user_spec');
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
		Schema::drop('job');
	}

}
