<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOthersTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('others', function($table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');			
			$table->string('agentName');
			$table->string('CAC');
			$table->string('Website');
			$table->string('address');
			$table->string('telephone');
			$table->string('email');
			$table->string('landline');
			$table->string('chairmantel');
			$table->string('chairmanemail');
			$table->string('chairmanname');
			$table->text('aboutus');
			$table->timestamps();
			# code...
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('others');
	}

}
