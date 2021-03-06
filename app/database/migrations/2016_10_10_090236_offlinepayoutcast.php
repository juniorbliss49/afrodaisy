<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Offlinepayoutcast extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('offlinepayoutcast', function($table)
		{
			$table->increments('id');
			$table->string('cast_id');
			$table->string('model_id');
			$table->string('ref_id');
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
		Schema::drop('offlinepayoutcast');
	}

}
