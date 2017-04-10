<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Onlinepayoutservices extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('onlinepayoutservices', function($table)
		{
			$table->increments('id');
			$table->string('service_id');
			$table->string('amount');
			$table->string('user_id');
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
		Schema::drop('onlinepayoutservices');
	}

}