<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUltrafineDustStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ultrafine_dust_standards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value');
            $table->string('condition',80);
            $table->string('phrases');
            $table->string('maker');
            $table->string('icon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ultrafine_dust_standards');
    }
}
