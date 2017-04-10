<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Offlinepayoutcourses extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Offlinepayoutcourses', function($table)
		{
			$table->increments('id');
			$table->string('course_id');
			$table->string('amount');
			$table->string('user_id');
			$table->string('ref_id');
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
		Schema::drop('Offlinepayoutcourses');
	}

}
