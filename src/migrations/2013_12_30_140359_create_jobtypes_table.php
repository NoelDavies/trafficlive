<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobTypes', function(Blueprint $table) {
			$table->integer('id')->unique();
			$table->date('dateCreated');
			$table->text('description');
			$table->string('value');
			$table->boolean('isDefault');
			$table->integer('colorCode');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jobTypes');
	}

}
