<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomsTable extends Migration {

	public function up()
	{
		Schema::create('classrooms', function(Blueprint $table) {
            $table->id();
			$table->string('classname');

			$table->bigInteger('Grade_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();



            
		});
	}

	public function down()
	{
		Schema::drop('classrooms');
	}
}
