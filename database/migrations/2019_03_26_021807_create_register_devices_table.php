<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_devices', function (Blueprint $table) {
            $table->string('device_id',40)->primary()->references('id')->on('devices')->onDelete('cascade');
            $table->integer('user_id')->references('id')->on('users');
            $table->dateTime('certification_date');
            $table->boolean('place');
            $table->string('details_name',40);
            $table->integer('management_id')->references('id')->on('managements')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_devices');
    }
}
