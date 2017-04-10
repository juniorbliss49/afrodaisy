<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCastfollowersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('castfollowers', function($table)
		{
			$table->increments('id');
			$table->integer('follower')->unsigned();
			$table->foreign('follower')->references('id')->on('users');
			$table->integer('following')->unsigned();
			$table->foreign('following')->references('id')->on('users');
			$table->date('followerdate');
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
		Schema::drop('castfollowers');
	}

}
