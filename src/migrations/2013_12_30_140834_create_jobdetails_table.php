<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobDetails', function(Blueprint $table) {
			$table->integer('id')->unique();
			$table->date('dateCreated');
			$table->text('jobDescription');
			$table->string('name');
			$table->text('notes');
			$table->integer('jobContactId');
			$table->integer('accountManagerId');
			$table->integer('ownerProjectId');
			$table->integer('jobTypeListITemId');
			$table->string('jobCostType');
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
		Schema::drop('jobDetails');
	}

}
