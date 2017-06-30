<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('countries', function (Blueprint $table) {
			$table->increments('id');
			$table->char('sortname',3);
			$table->char('name',150);
			$table->integer('phonecode')->unsigned();
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
         Schema::drop('countries');
    }
}
