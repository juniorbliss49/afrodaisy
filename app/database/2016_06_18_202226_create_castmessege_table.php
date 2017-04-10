<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCastmessegeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('castmessage', function($table)
		{
			$table->increments('id');
			$table->integer('sender')->unsigned();
			$table->foreign('sender')->references('id')->on('users');
			$table->integer('reciever')->unsigned();
			$table->foreign('reciever')->references('id')->on('users');
			$table->string('msgtitle');
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
		Schema::drop('castmessage');
	}

}
