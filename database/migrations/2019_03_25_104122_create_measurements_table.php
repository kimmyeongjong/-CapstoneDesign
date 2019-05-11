<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->bigIncrements('num');
            $table->string('device_id',40)->references('device_id')->on('devices');
            $table->float('ultrafine_dust');
            $table->float('fine_dust');
            $table->float('temperature');
            $table->float('humidity');
            $table->float('latitude');
            $table->float('longitude');
            $table->integer('co2')->nullable();
            $table->integer('vocs')->nullable();
            $table->dateTime('measurements_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('measurements');
    }
}
