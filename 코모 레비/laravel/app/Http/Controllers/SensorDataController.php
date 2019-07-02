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
            'device_id' => 2,
//                'ultrafine_dust' => $request['UltrafineDust'],
            'fine_dust' => $request['FineDust'],
            'humidity'=> $request['Humidity'],
            'temperature' => $request['Temperature'],
//                'latitude' => $request['Latitude'],
//                'longitude' => $request->Logitude,
            //'humidity' => $request->Humidity,
            'co2' => $request['Co2'],
//                'vocs' => $obj->vocs,
            'measurements_time' => date_format(now(),'Y-m-d H:i:s')
        ]);


    }

}