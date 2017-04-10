<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Onlinepayoutcast extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('onlinepayoutcast', function($table)
		{
			$table->increments('id');
			$table->string('cast_id');
			$table->string('model_id');
			$table->string('amount');
			$table->string('ref_id');
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
		Schema::drop('onlinepayoutcast');
	}

}
