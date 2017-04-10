<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceMarket extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('servicemarketplace', function($table)
		{
			# code...
			$table->increments('id');
			$table->string('user_id');
			$table->string('name');
			$table->text('description');
			$table->string('country');
			$table->string('location');
			$table->string('city');
			$table->string('image');
			$table->string('price');
			$table->string('discount');
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
		Schema::drop('servicemarketplace');
	}

}
