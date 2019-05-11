<?php

namespace App\Http\Controllers;
use App\RegisterDevice;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){
        $dd=RegisterDevice::select('device_id')->get();
        return $dd;
    }
}
