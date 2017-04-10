<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCastingTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('castingType', function($table)
		{
		$table->increments('id');
		$table->integer('castId')->unsigned();
		$table->foreign('castId')->references('id')->on('casting');
		$table->integer('castType')->unsigned();
		$table->foreign('castType')->references('id')->on('categories');
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
		Schema::drop('castingType');
	}

}
