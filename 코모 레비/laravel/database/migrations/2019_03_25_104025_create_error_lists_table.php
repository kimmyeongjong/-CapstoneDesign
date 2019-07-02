<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErrorListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('error_lists', function (Blueprint $table) {
            $table->bigIncrements('num');
            $table->string('device_id',40)->references('device_id')->on('register_devices');
            $table->integer('error_id')->references('error_id')->on('errors');
            $table->dateTime('error_date');
            $table->boolean('error_state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('error_lists');
    }
}
