<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCastlikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('castlikes', function($table)
		{
			$table->increments('id');
			$table->integer('likessender')->unsigned();
			$table->foreign('likessender')->references('id')->on('users');
			$table->integer('likesreciever')->unsigned();
			$table->foreign('likesreciever')->references('id')->on('users');
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
		Schema::drop('castlikes');
	}

}
