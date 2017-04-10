<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCastpreferenceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('castpreference', function($table)
		{
			$table->increments('id');
			$table->integer('prefId')->unsigned();
			$table->foreign('prefId')->references('id')->on('preferences');
			$table->integer('castId')->unsigned();
			$table->foreign('castId')->references('id')->on('casting');
			$table->integer('preFrom');
			$table->integer('preTo');
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
		Schema::drop('castpreference');
	}

}
