<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStaffEmployeeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('staffEmployee', function(Blueprint $table) {
			$table->integer('id')->unique();
			$table->integer('locationId');
			$table->integer('departmentId');
			$table->integer('ownerCompanyId');
			$table->boolean('active');
			$table->integer('userId');
			$table->string('userName');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('staffEmployee');
	}

}
