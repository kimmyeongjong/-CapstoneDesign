<?php

namespace App\Http\Controllers;

use App\Measurement;
use Illuminate\Support\Facades\DB;
use Auth;
use JWTAuth;
use App\User;
use App\Management;
use App\RegisterDevice;
class ManagementController extends Controller
{
    public function area(){
//auth()->user()->id
        $now = date_format(now(),'Y.m.d / H시');
        //관리자의 관리장소
        $area = Management::select('area_name','area_si','area_gu','area_dong')
            ->where('user_id', 1)->first();
        //1시간 전 - 현재시간
        $now_time = \Carbon\Carbon::now();
        $sub_time = \Carbon\Carbon::now()->subHour(1);

        //관리자가 존재하는 구역 중 미세먼지가 가장 나쁜 장소
        $find_dangerous = RegisterDevice::join('measurements', 'register_devices.device_id', '=', 'measurements.device_id')
                                        ->join('managements', 'register_devices.management_id','=','managements.id')
                                        ->select(DB::raw('managements.id'))
                                        ->where('managements.area_si', '=', $area->area_si)
                                        ->whereDate('measurements.measurements_time', '=', date('Y-m-d'))
                                        ->whereBetween('measurements.measurements_time', [$sub_time, $now_time])
                                        ->groupby('managements.id')
                                        ->orderByRaw('avg(ultrafine_dust) DESC')
                                        ->limit(1)
                                        ->get();
        
        //위험지역에 대한 정보
        $dangerous = Management::select('area_name','area_si','area_gu','area_dong')
                                ->find($find_dangerous);

        /*시간의 표준 대기 현황*/
        //초미세먼지
        $ultrafine_dust = RegisterDevice::join('measurements', 'register_devices.device_id', '=', 'measurements.device_id')
                                        ->orWhere(function ($query) {
                                            $query->where('register_devices.user_id', 1)
                                                ->whereDate('measurements.measurements_time', '=', date('Y-m-d'));
                                        })
                                        ->whereBetween('measurements.measurements_time', [$sub_time, $now_time])
                                        ->avg('ultrafine_dust');

        //미세먼지
        $fine_dust = RegisterDevice::join('measurements', 'register_devices.device_id', '=', 'measurements.device_id')
                                    ->orWhere(function ($query) {
                                        $query->where('register_devices.user_id', 1)
                                            ->whereDate('measurements.measurements_time', '=', date('Y-m-d'));
                                    })
                                    ->whereBetween('measurements.measurements_time', [$sub_time, $now_time])
                                    ->avg('fine_dust');

        //온도
        $temperature = RegisterDevice::join('measurements', 'register_devices.device_id', '=', 'measurements.device_id')
                                    ->orWhere(function ($query) {
                                        $query->where('register_devices.user_id', 1)
                                            ->whereDate('measurements.measurements_time', '=', date('Y-m-d'));
                                    })
                                    ->whereBetween('measurements.measurements_time', [$sub_time, $now_time])
                                    ->avg('temperature');

        //습도
        $humidity = RegisterDevice::join('measurements', 'register_devices.device_id', '=', 'measurements.device_id')
                                    ->orWhere(function ($query) {
                                        $query->where('register_devices.user_id', 1)
                                            ->whereDate('measurements.measurements_time', '=', date('Y-m-d'));
                                    })
                                    ->whereBetween('measurements.measurements_time', [$sub_time, $now_time])
                                    ->avg('humidity');

        return response([
            'now_time' => $now,
            'management_area' => $area,
            "danger_area" => $dangerous,
            'avg_management_area' => [
                                'ultrafine_dust' => round($ultrafine_dust, 0),
                                'fine_dust' => round($fine_dust, 0),
                                'temperature' => round($temperature, 0),
                                'humidity' => round($humidity, 0),
                                ],
        ]);
    }

    public function location($select){
        //가장 최근의 기기의 위도와 경도 위치제공
        $standards = DB::table($select.'_standards')->get();

        $avg = [
            'value'=>[],
            'condition'=>[],
            'phrases'=>[],
            'maker'=>[],
        ];

        foreach($standards as $index=>$dat){
            $avg['value'][$index] = $dat->value;
        }
        foreach($standards as $index=>$dat){
            $avg['condition'][$index] = $dat->condition;
        }
        foreach($standards as $index=>$dat){
            $avg['phrases'][$index] = $dat->phrases;
        }
        foreach($standards as $index=>$dat){
            $avg['maker'][$index] = $dat->maker;
        }

        $arr = RegisterDevice::select('device_id')->where('user_id',1)->get();

        $value = [];

        for($i=0;$i<count($arr); $i++) {
            $value[$i] = Measurement::select('' . $select . ' as data', 'latitude', 'longitude', 'device_id',
                                        DB::raw('(CASE
                                            WHEN '.$select.' >= '.$avg['value'][3].' THEN '.$avg['maker'][3].'
                                            WHEN ('.$select.' >= '.$avg['value'][2].' AND '. $select .' < '.$avg['value'][3].') THEN '.$avg['maker'][2].'
                                            WHEN ('.$select.' >= '.$avg['value'][1].' AND '. $select .' < '.$avg['value'][2].') THEN '.$avg['maker'][1].'
                                            WHEN ('.$select.' >= '.$avg['value'][0].' AND '. $select .' < '.$avg['value'][1].') THEN '.$avg['maker'][0].'
                                            END) as "icon"')
                                    )
                                    ->where('device_id',$arr[$i]['device_id'])
                                    ->orderBy('longitude', 'DESC')
                                    ->limit(1)
                                    ->get();
        }

        return response($value);
    }

    public function time_area($start_time){

        //30분 간격의 시간대 출력
        $minutes = $start_time*60;
        $thirty_minutes = [];

        for($i=0; $i<7; $i++){
            if($minutes%60 == 0){
                $time = ($minutes/60).':00';
            }else{
                $time = floor($minutes/60).':30';
            }

            $thirty_minutes[$i] = $time;
            $minutes+=30;
        }

        $end_time = $start_time+3;

        if($start_time<10){
            $start_time = '0'.$start_time.'0000';
        }else{
            $start_time = $start_time.'0000';
        }

        if($end_time<10){
            $end_time = '0'.$end_time.'0000';
        }else if($end_time>=24){
            $end_time = '233000';
        }
        else{
            $end_time = $end_time.'0000';
        }

        //시간에 따른 대기질 평균 정보 : 0-3시, 3-6시, 6-9시, 9-12시, 12-15시, 15-18시, 18-21시, 21-23시

        //관리자의 기기 시간 별 통계초미세먼지
        $ultrafine_dust_standards = DB::table('ultrafine_dust_standards')->get();

        $ultra_avg = [
            'value'=>[],
            'icon'=>[],
        ];

        foreach($ultrafine_dust_standards as $index=>$dat){
            $ultra_avg['value'][$index] = $dat->value;
        }
        foreach($ultrafine_dust_standards as $index=>$dat){
            $ultra_avg['icon'][$index] = $dat->icon;
        }

        $fine_dust_standards = DB::table('fine_dust_standards')->get();

        $fine_avg = [
            'value'=>[],
            'icon'=>[],
        ];

        foreach($fine_dust_standards as $index=>$dat){
            $fine_avg['value'][$index] = $dat->value;
        }
        foreach($fine_dust_standards as $index=>$dat){
            $fine_avg['icon'][$index] = $dat->icon;
        }

        $avg_time_data = RegisterDevice::join('measurements', 'register_devices.device_id', '=', 'measurements.device_id')
                                        ->select(
                                            'measurements_time',
                                            DB::raw('date_format(measurements_time,\'%H%i%s\') as Dum'),
                                            DB::raw('CONCAT(HOUR(measurements_time),\':\', LPAD(MINUTE(measurements_time) DIV 30 * 30, 2, 0))as Time'),
                                            DB::raw('(CASE
                                                    WHEN avg(ultrafine_dust) >= '.$ultra_avg['value'][3].' THEN '.$ultra_avg['icon'][3].'
                                                    WHEN (avg(ultrafine_dust) >= '.$ultra_avg['value'][2].' AND avg(ultrafine_dust) < '.$ultra_avg['value'][3].') THEN '.$ultra_avg['icon'][2].'
                                                    WHEN (avg(ultrafine_dust) >= '.$ultra_avg['value'][1].' AND avg(ultrafine_dust) < '.$ultra_avg['value'][2].') THEN '.$ultra_avg['icon'][1].'
                                                    WHEN (avg(ultrafine_dust) >= '.$ultra_avg['value'][0].' AND avg(ultrafine_dust) < '.$ultra_avg['value'][1].') THEN '.$ultra_avg['icon'][0].'
                                                    END) as "ultrafine_dust"'),
                                            DB::raw('(CASE
                                                    WHEN avg(fine_dust) >= '.$fine_avg['value'][3].' THEN '.$fine_avg['icon'][3].'
                                                    WHEN (avg(fine_dust) >= '.$fine_avg['value'][2].' AND avg(fine_dust) < '.$fine_avg['value'][3].') THEN '.$fine_avg['icon'][2].'
                                                    WHEN (avg(fine_dust) >= '.$fine_avg['value'][1].' AND avg(fine_dust) < '.$fine_avg['value'][2].') THEN '.$fine_avg['icon'][1].'
                                                    WHEN (avg(fine_dust) >= '.$fine_avg['value'][0].' AND avg(fine_dust) < '.$fine_avg['value'][1].') THEN '.$fine_avg['icon'][0].'
                                                    END) as "fine_dust"'),
                                            DB::raw('avg(temperature) as temperature'),
                                            DB::raw('avg(humidity) as humidity')
                                        )
                                        ->where(DB::raw('date(measurements_time)'),date('Y-m-d'))
                                        ->where('user_id',1)
                                        ->groupBy(DB::raw('substr(date_format(measurements_time,\'%Y%m%d%H%i%s\'),1,10),
                                                                      floor(substr(date_format(measurements_time,\'%Y%m%d%H%i%s\'),11,2)/30)'))
                                        ->havingRaw('Dum between '.$start_time.' and '.$end_time.'')
                                        ->orderby('measurements_time','ASC')
                                        ->get();

        $value = [
            'data_ultrafine_dust' => [],
            'data_fine_dust' => [],
            'data_temperature'=>[],
            'data_humidity'=>[],
        ];

        foreach($avg_time_data as $index=>$dat){
            $value['data_ultrafine_dust'][$index] = $dat->ultrafine_dust;
        }
        foreach($avg_time_data as $index=>$dat){
            $value['data_fine_dust'][$index] = $dat->fine_dust;
        }
        foreach($avg_time_data as $index=>$dat){
            $value['data_temperature'][$index] = $dat->temperature;
        }
        foreach($avg_time_data as $index=>$dat){
            $value['data_humidity'][$index] = $dat->humidity;
        }


        return response([
            'time' => $thirty_minutes,
            'ultrafine_dust' => $value['data_ultrafine_dust'],
            'fine_dust' => $value['data_fine_dust'],
            'temperature' => $value['data_temperature'],
            'humidity' => $value['data_humidity'],
        ]);
    }

    public function myDevice($select){

        $error_cnt = RegisterDevice::join('error_lists','register_devices.device_id','=','error_lists.device_id')
                                    ->select(DB::raw('COUNT(distinct error_lists.device_id) as error_cnt'))
                                    ->where('user_id',1)
                                    ->where('error_state',0)
                                    ->count();

        if($error_cnt>0){
            $err = RegisterDevice::join('error_lists', 'register_devices.device_id', '=', 'error_lists.device_id')
                                    ->select('error_lists.device_id')
                                    ->where('user_id',1)
                                    ->where('error_state',0)
                                    ->get();

            $error_list = [];
            for($i=0;$i<count($err); $i++){
                $error_list[$i] = RegisterDevice::join('measurements', 'register_devices.device_id', '=', 'measurements.device_id')
                                                ->join('error_lists', 'register_devices.device_id', '=', 'error_lists.device_id')
                                                ->select('measurements.device_id','register_devices.details_name',''.$select.' as data','error_date as time',
                                                    DB::raw('if(error_lists.error_id = 0, "오류발생", "정상") as "err_off"'),
                                                    DB::raw('if(error_lists.error_id = 1, "오류발생", "정상") as "err_data"'),
                                                    DB::raw('if(error_lists.error_id = 2, "오류발생", "정상") as "err_num"')
                                                )
                                                ->where('register_devices.device_id',$err[$i]['device_id'])
                                                ->orderBy('measurements_time','DESC')
                                                ->limit(1)
                                                ->get();
            }

            $err_num=[];

            foreach($err as $index=>$dat){
                $err_num[$index] = $dat->device_id;
            }

            $normal = RegisterDevice::select('device_id')
                                    ->where('user_id',1)
                                    ->whereNotIn('device_id', $err_num)
                                    ->get();

            $normal_list = [];

            for($i=0;$i<count($normal); $i++){
                $normal_list[$i] = RegisterDevice::join('measurements', 'register_devices.device_id', '=', 'measurements.device_id')
                                                ->select('measurements.device_id','register_devices.details_name',''.$select.' as data','measurements_time as time',
                                                    DB::raw('"정상" as "err_off"'),
                                                    DB::raw('"정상" as "err_data"'),
                                                    DB::raw('"정상" as "err_num"'))
                                                ->where('register_devices.device_id',$normal[$i]['device_id'])
                                                ->orderBy('measurements_time','DESC')
                                                ->limit(1)
                                                ->get();
            }

            $list = [
                'err' => $error_list,
                'normal' => $normal_list
            ];

        }else{

            $normal = RegisterDevice::select('device_id')
                ->where('user_id',1)
                ->get();

            $normal_list = [];

            for($i=0;$i<count($normal); $i++){
                $normal_list[$i] = RegisterDevice::join('measurements', 'register_devices.device_id', '=', 'measurements.device_id')
                                                    ->select('measurements.device_id','register_devices.details_name',''.$select.' as data','measurements_time as time',
                                                        DB::raw('"정상" as "err_off"'),
                                                        DB::raw('"정상" as "err_data"'),
                                                        DB::raw('"정상" as "err_num"'))
                                                    ->where('register_devices.device_id',$normal[$i]['device_id'])
                                                    ->orderBy('measurements_time','DESC')
                                                    ->limit(1)
                                                    ->get();
            }

            $list = [
                'normal' => $normal_list
            ];
        }

        return response([
           'list' => $list
        ]);

    }

    public function errorList(){
        //관리자 총기기수
        $all_cnt = RegisterDevice::where('user_id',1)
                                ->count();

        //관리자 오류 기기 수
        $error_cnt = RegisterDevice::join('error_lists','register_devices.device_id','=','error_lists.device_id')
                                    ->select(DB::raw('COUNT(distinct error_lists.device_id) as error_cnt'))
                                    ->where('user_id',1)
                                    ->where('error_state',0)
                                    ->count();

        return response([
            'all_device_count' => $all_cnt,
            'error_device_count' => $error_cnt,
        ]);
    }

    public function deviceInfo($id){
        //가장최근 날짜의 각 각의 기기정보 표시
        $arr = RegisterDevice::select('device_id')->where('user_id',1)->where('device_id',$id)->get();

        $device = Measurement::select('measurements.device_id','latitude','longitude','ultrafine_dust','fine_dust')
                                ->where('device_id',$arr[0]['device_id'])
                                ->orderBy('measurements_time','desc')
                                ->limit(1)
                                ->get();

        return response($device);
    }

    public function statistics($id){
        //해당 기기의 전체 정보
        $value = RegisterDevice::join('measurements', 'register_devices.device_id', '=', 'measurements.device_id')
                                ->select('measurements_time','ultrafine_dust','fine_dust','temperature','humidity')
                                ->where('user_id',1)
                                ->where('measurements.device_id','=', $id)
                                ->orderBy('measurements_time','desc')
                                ->get();

        return response([
            $value
        ]);
    }
}
