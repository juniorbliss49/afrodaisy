<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Imagelikes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('imagelikes', function($table)
		{
			$table->increments('id');
			$table->string('imageid');
			$table->string('user_id');
			$table->string('sender_id');
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
		Schema::drop('imagelikes');
	}

}
