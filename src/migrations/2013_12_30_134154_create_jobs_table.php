<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobs', function(Blueprint $table) {
			$table->integer('id')->unique();;
			$table->date('dateCreated');
			$table->integer('jobNumber');
			$table->string('jobStateType');
			$table->integer('jobDetailId');
			$table->boolean('billableJob');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jobs');
	}

}
