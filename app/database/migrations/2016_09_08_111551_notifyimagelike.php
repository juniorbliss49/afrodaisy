<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notifyimagelike extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Notifyimagelike', function($table)
		{
			# code...
			$table->increments('id');
			$table->string('NotId');
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
		Schema::drop('Notifyimagelike');
	}

}
