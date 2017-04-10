<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Othersjobpayment extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('othersjobpayment', function($table)
		{
			$table->increments('id');
			$table->string('job_id');
			$table->string('user_id');
			$table->string('rec_id');
			$table->string('amount');
			$table->string('status');
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
		Schema::drop('othersjobpayment');
	}

}
