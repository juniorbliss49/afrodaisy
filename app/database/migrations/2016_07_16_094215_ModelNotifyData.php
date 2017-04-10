<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModelNotifyData extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('ModelNofity', function($table)
		{
			# code...
			$table->increments('id');
			$table->integer('NotId')->unsigned();
			$table->foreign('NotId')->references('id')->on('notification');
			$table->string('date');
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
		//
		Schema::drop('ModelNofity');
	}

}
