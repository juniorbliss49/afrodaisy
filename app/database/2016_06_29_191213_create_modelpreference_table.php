<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelpreferenceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('modelpreference', function($table)
		{
			$table->increments('id');
			$table->integer('prefId')->unsigned();
			$table->foreign('prefId')->references('id')->on('preferences');
			$table->integer('modelId')->unsigned();
			$table->foreign('modelId')->references('id')->on('models');
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
		Schema::drop('modelpreference');
	}

}
