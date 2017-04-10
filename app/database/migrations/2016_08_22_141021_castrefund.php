<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Castrefund extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('castrefund', function($table)
		{
			$table->increments('id');
			$table->string('cast_id');
			$table->string('user_id');
			$table->integer('amount');
			$table->timestamps('id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('castrefund');
	}

}
