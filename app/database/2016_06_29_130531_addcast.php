<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addcast extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('casting', function($table) {
			$table->integer('Dayend')->after('DayExp');
			$table->integer('Monthend')->after('DayExp');
			$table->integer('Yearend')->after('DayExp');
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('casting', function($table) {
        $table->dropColumn('Dayend');
        $table->dropColumn('Monthend');
        $table->dropColumn('Yearend');
	});

}
}

