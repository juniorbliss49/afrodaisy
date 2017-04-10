<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCastingTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('casting', function($table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->string('castTitle');
			$table->text('castDescription');
			$table->string('castTask');
			$table->text('castRequirement');
			$table->string('payType');
			$table->string('payDesc');
			$table->string('location');
			$table->string('area');
			$table->integer('Daycast');
			$table->integer('Monthcast');
			$table->integer('Yearcast');
			$table->string('castImage');
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
		Schema::drop('casting');
	}

}
