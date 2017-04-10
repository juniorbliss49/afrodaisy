<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notifyupcomingjobstatus extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Notifyupcomingjobstatus', function($table)
		{
			$table->increments('id');
			$table->string('NotId');
			$table->string('upcoomingId');
			$table->string('user_id');
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
		Schema::drop('Notifyupcomingjobstatus');
	}

}
