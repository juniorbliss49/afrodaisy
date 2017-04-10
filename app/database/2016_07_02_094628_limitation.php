<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Limitation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('limitation', function($table)
		{
			$table->increments('id');
			$table->string('cat_select');
			$table->string('cast-apply');
			$table->string('socianNetwork');
			$table->string('recognition');
			$table->string('listing');
			$table->string('othersContact');
			$table->string('emailAlert');
			$table->integer('plan-id')->unsigned();
			$table->foreign('plan-id')->references('id')->on('plan');
			$table->string('val');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('limitation');
	}

}
