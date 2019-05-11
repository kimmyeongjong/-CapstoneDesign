<?php

namespace App\Http\Controllers;

use App\Measurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class SensorDataController extends Controller
{
    public function Measurements_info(Request $request){

//        $request = '{"Temperature":"28.00","Humidity":"50.00","Co2":"832","FineDust":"22.23"}';

        Measurement::create([
            'device_id' => $request['device_id'],
            'ultrafine_dust' => $request['UltraFineDust'],
            'fine_dust' => $request['FineDust'],
            'humidity'=> $request['Humidity'],
            'temperature' => $request['Temperature'],
            'latitude' => $request['Latitude'],
            'longitude' => $request['Longtitude'],
            'co2' => $request['Co2'],
            'vocs' => $request['Vocs'],
            'measurements_time' => $request['Year'].'-'.$request['Month'].'-'.$request['Day'].' '.$request['Hour'].''.$request['Minute'],
        ]);

    }

}