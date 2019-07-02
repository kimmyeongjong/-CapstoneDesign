<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    //
    protected $fillable = ['device_id', 'ultrafine_dust', 'fine_dust', 'temperature', 'humidity', 'latitude','longitude', 'co2', 'vocs', 'measurements_time'];

    public $timestamps = false;
}
