<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notifylikephotoscomment extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifylikephotoscomment', function($table)
		{
			$table->increments('id');
			$table->string('user_id');
			$table->string('NotId');
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
		Schema::drop('notifylikephotoscomment');
	}

}
