<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCastTableTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('CastTable', function($table)
		{
			$table->increments('id');
			$table->integer('cast_id')->unsigned();
			$table->foreign('cast_id')->references('id')->on('casting');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->string('castMethod');
			$table->string('castRequest');
			$table->string('castStatus');
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
		Schema::drop('CastTable');
	}

}
