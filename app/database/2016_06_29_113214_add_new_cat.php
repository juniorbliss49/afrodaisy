<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewCat extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
{
    Schema::table('casting', function($table) {
        $table->integer('castCat')->unsigned()->after('castTitle');
		$table->foreign('castCat')->references('id')->on('disciplines');
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
        $table->dropColumn('castCat');
    });
	}

}
