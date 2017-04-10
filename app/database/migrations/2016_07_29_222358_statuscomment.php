<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Statuscomment extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('statuscomment', function($table)
		{
			# code...
			$table->increments('id');
			$table->string('statusId');
			$table->string('user_id');
			$table->text('comment');
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
		Schema::drop('statuscomment');
	}

}