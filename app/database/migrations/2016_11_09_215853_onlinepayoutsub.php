<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Onlinepayoutsub extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('onlinepayoutsub', function($table)
		{
			$table->increments('id');
			$table->string('sub_id');
			$table->string('user_id');
			$table->string('ref_id');
			$table->string('status');
			$table->string('amount');
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
		Schema::drop('onlinepayoutsub');
	}

}
