<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('models', function($table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->string('firstName');
			$table->string('lastName');
			$table->string('displayName');
			$table->string('gender');
			$table->string('country');
			$table->string('email');
			$table->string('phone');
			$table->smallInteger('Age');
			$table->smallInteger('Height');
			$table->text('about');
			$table->integer('DayofBirth');
			$table->integer('MonthOfBirth');
			$table->integer('YearofBirth');
			$table->string('location');
			$table->string('town');
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
		Schema::drop('models');
	}

}
