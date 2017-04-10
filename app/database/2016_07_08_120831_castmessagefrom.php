<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Castmessagefrom extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Castmessagefrom', function($table)
		{
			# code...
			$table->increments('id');
			$table->integer('to')->unsigned();
			$table->foreign('to')->references('id')->on('users');
			$table->integer('from')->unsigned();
			$table->foreign('from')->references('id')->on('users');
			$table->string('msgread');
			$table->text('message');
			$table->date('msgdate');
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
	}

}
