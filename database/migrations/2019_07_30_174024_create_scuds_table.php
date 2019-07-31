<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scuds', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('numBuild');
			$table->string('numLevel');
			$table->string('numDoor');
			$table->integer('is_mag');
			$table->integer('is_electrified');
			$table->integer('is_worked');
			$table->string('email');
			$table->string('name');
			$table->string('info');
			$table->integer('sentby');
			$table->integer('bitrix');
			$table->integer('closed');
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
        Schema::dropIfExists('scuds');
    }
}
