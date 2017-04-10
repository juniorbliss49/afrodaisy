<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherpreferenceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('otherpreference', function($table)
		{
			$table->increments('id');
			$table->integer('prefId2')->unsigned();
			$table->foreign('prefId2')->references('id')->on('preferences');
			$table->string('prefval');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('otherpreference');
	}

}
