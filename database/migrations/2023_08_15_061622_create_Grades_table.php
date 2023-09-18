<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;


class CreateGradesTable extends Migration {

    use SoftDeletes;

	public function up()
	{
		Schema::create('Grades', function(Blueprint $table) {
			$table->id('id');
			$table->timestamps();
			$table->string('Name');
			
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('Grades');
	}
}
