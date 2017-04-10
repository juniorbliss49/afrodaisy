<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notifystatuslike extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('Notifystatuslike', function($table)
		{
			# code...
			$table->increments('id');
			$table->string('NotId');
			$table->string('statusId');
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
		//
		Schema::drop('Notifystatuslike');
	}

}
