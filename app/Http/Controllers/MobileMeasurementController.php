<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Measurement;
use App\RegisterDevice;
class MobileMeasurementController extends Controller
{
    public function measurements($select){
        //매개변수에 따른 사용자별 시간 데이터
        $time = RegisterDevice::join('measurements', 'register_devices.device_id', '=', 'measurements.device_id')
                                ->selectRaw('DATE_FORMAT(measurements_time, "%Y년%m월%d일 %H시%i분") as time')
                                ->where('register_devices.user_id', 9)
                                ->orderBy('measurements_time', 'ASC')
                                ->get();


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

        $value = RegisterDevice::join('measurements', 'register_devices.device_id', '=', 'measurements.device_id')
                                ->select(''.$select.' as data','latitude','longitude',
                                    DB::raw('(CASE
                                            WHEN '.$select.' >= '.$avg['value'][3].' THEN '.$avg['condition'][3].'
                                            WHEN ('.$select.' >= '.$avg['value'][2].' AND '.$select.' < '.$avg['value'][3].') THEN '.$avg['condition'][2].'
                                            WHEN ('.$select.' >= '.$avg['value'][1].' AND '.$select.' < '.$avg['value'][2].') THEN '.$avg['condition'][1].'
                                            WHEN ('.$select.' >= '.$avg['value'][0].' AND '.$select.' < '.$avg['value'][1].') THEN '.$avg['condition'][0].'
                                            END) as "condition"'),
                                    DB::raw('(CASE
                                            WHEN '.$select.' >= '.$avg['value'][3].' THEN '.$avg['phrases'][3].'
                                            WHEN ('.$select.' >= '.$avg['value'][2].' AND '.$select.' < '.$avg['value'][3].') THEN '.$avg['phrases'][2].'
                                            WHEN ('.$select.' >= '.$avg['value'][1].' AND '.$select.' < '.$avg['value'][2].') THEN '.$avg['phrases'][1].'
                                            WHEN ('.$select.' >= '.$avg['value'][0].' AND '.$select.' < '.$avg['value'][1].') THEN '.$avg['phrases'][0].'
                                            END) as "phrases"'),
                                    DB::raw('(CASE
                                            WHEN '.$select.' >= '.$avg['value'][3].' THEN '.$avg['maker'][3].'
                                            WHEN ('.$select.' >= '.$avg['value'][2].' AND '.$select.' < '.$avg['value'][3].') THEN '.$avg['maker'][2].'
                                            WHEN ('.$select.' >= '.$avg['value'][1].' AND '.$select.' < '.$avg['value'][2].') THEN '.$avg['maker'][1].'
                                            WHEN ('.$select.' >= '.$avg['value'][0].' AND '.$select.' < '.$avg['value'][1].') THEN '.$avg['maker'][0].'
                                            END) as "icon"')
                                )
                                ->where('user_id',9)
                                ->orderBy('measurements_time', 'ASC')
                                ->get();

        $data = [
            'label'=>$select,
            'data'=>[
                'time'=>[],
                'value'=> $value,
            ]
        ];

        foreach($time as $index=>$dat){
            $data['data']['time'][$index] = $dat->time;
        }

        return response($data);
    }

    public function time_date($select){
        //날짜별 묶음
        $arr =  RegisterDevice::join('measurements', 'register_devices.device_id', '=', 'measurements.device_id')
            ->select(DB::raw("DATE_FORMAT(measurements_time,'%Y년 %m월 %d일') as date"))
            ->where('register_devices.user_id', 9)
            ->groupBy('date')->get();
        $temp = [];

        for($i=0;$i<count($arr); $i++) {
            $temp[$i] = RegisterDevice::join('measurements', 'register_devices.device_id', '=', 'measurements.device_id')
                ->select('' . $select . ' as data',
                    DB::raw("DATE_FORMAT(measurements_time,'%H:%i') as date"))
                ->where('register_devices.user_id', 9)
                ->where(DB::raw("DATE_FORMAT(measurements_time,'%Y년 %m월 %d일')"), $arr[$i]['date'])
                ->orderBy('measurements_time', 'ASC')
                ->get();
        }

        $avg = [];

        for($i=0; $i<count($temp); $i++) {
            foreach($temp[$i] as $index=>$dat){
                $avg[$i][$index] = [$dat->date=>$dat->data];
            }
        }

        $time_data = [];

        for($i=0; $i<count($temp); $i++) {
            foreach($temp[1] as $index=>$dat){
                $time_data[$i] = [$arr[$i]['date'] =>[
                    $avg[$i]
                ]];
            }
        }

        return $time_data;
    }

    public function lately_data($select){
        //가장 최근의 데이터

        $arr = RegisterDevice::select('device_id')->where('user_id',9)->get(); //이것을 가장 가까운 값의 위도 경도를 구하는 식으로 바꾸기

        $lately = [];

        $standards = DB::table($select.'_standards')->get();

        $avg = [
            'value'=>[],
            'condition'=>[],
            'phrases'=>[],
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

        for($i=0;$i<count($arr); $i++){
            $lately[$i] =RegisterDevice::join('measurements', 'register_devices.device_id', '=', 'measurements.device_id')
                                        ->select('register_devices.device_id','user_id','details_name',''.$select.' as data',
                                            DB::raw('(CASE
                                            WHEN '.$select.' >= '.$avg['value'][3].' THEN '.$avg['condition'][3].'
                                            WHEN ('.$select.' >= '.$avg['value'][2].' AND '.$select.' < '.$avg['value'][3].') THEN '.$avg['condition'][2].'
                                            WHEN ('.$select.' >= '.$avg['value'][1].' AND '.$select.' < '.$avg['value'][2].') THEN '.$avg['condition'][1].'
                                            WHEN ('.$select.' >= '.$avg['value'][0].' AND '.$select.' < '.$avg['value'][1].') THEN '.$avg['condition'][0].'
                                            END) as "condition"'),
                                            DB::raw('(CASE
                                            WHEN '.$select.' >= '.$avg['value'][3].' THEN '.$avg['phrases'][3].'
                                            WHEN ('.$select.' >= '.$avg['value'][2].' AND '.$select.' < '.$avg['value'][3].') THEN '.$avg['phrases'][2].'
                                            WHEN ('.$select.' >= '.$avg['value'][1].' AND '.$select.' < '.$avg['value'][2].') THEN '.$avg['phrases'][1].'
                                            WHEN ('.$select.' >= '.$avg['value'][0].' AND '.$select.' < '.$avg['value'][1].') THEN '.$avg['phrases'][0].'
                                            END) as "phrases"'),
                                            'latitude','longitude','measurements_time','place')
                                        ->where('measurements.device_id',$arr[$i]['device_id'])
                                        ->orderBy('measurements_time','desc')
                                        ->limit(1)
                                        ->get();
        }

        return response([
            'lately_data' => $lately,
        ]);
    }

    public function all_devices_info($select){
        //매개변수에 따른 상태 표시 - 전체 데이터 표시 - 위도 경도에 따라 계산
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

        $arr = RegisterDevice::select('device_id')->get();

            $lately = [];

            for($i=0;$i<count($arr); $i++) {
                $lately[$i] = RegisterDevice::join('measurements', 'register_devices.device_id', '=', 'measurements.device_id')
                                            ->select('' . $select . ' as data', 'latitude', 'longitude',
                                                DB::raw('(CASE
                                                WHEN '.$select.' >= '.$avg['value'][3].' THEN '.$avg['condition'][3].'
                                                WHEN ('.$select.' >= '.$avg['value'][2].' AND '.$select.' < '.$avg['value'][3].') THEN '.$avg['condition'][2].'
                                                WHEN ('.$select.' >= '.$avg['value'][1].' AND '.$select.' < '.$avg['value'][2].') THEN '.$avg['condition'][1].'
                                                WHEN ('.$select.' >= '.$avg['value'][0].' AND '.$select.' < '.$avg['value'][1].') THEN '.$avg['condition'][0].'
                                                END) as "condition"'),
                                                DB::raw('(CASE
                                                WHEN '.$select.' >= '.$avg['value'][3].' THEN '.$avg['phrases'][3].'
                                                WHEN ('.$select.' >= '.$avg['value'][2].' AND '.$select.' < '.$avg['value'][3].') THEN '.$avg['phrases'][2].'
                                                WHEN ('.$select.' >= '.$avg['value'][1].' AND '.$select.' < '.$avg['value'][2].') THEN '.$avg['phrases'][1].'
                                                WHEN ('.$select.' >= '.$avg['value'][0].' AND '.$select.' < '.$avg['value'][1].') THEN '.$avg['phrases'][0].'
                                                END) as "phrases"'),
                                                DB::raw('(CASE
                                                WHEN '.$select.' >= '.$avg['value'][3].' THEN '.$avg['maker'][3].'
                                                WHEN ('.$select.' >= '.$avg['value'][2].' AND '.$select.' < '.$avg['value'][3].') THEN '.$avg['maker'][2].'
                                                WHEN ('.$select.' >= '.$avg['value'][1].' AND '.$select.' < '.$avg['value'][2].') THEN '.$avg['maker'][1].'
                                                WHEN ('.$select.' >= '.$avg['value'][0].' AND '.$select.' < '.$avg['value'][1].') THEN '.$avg['maker'][0].'
                                                END) as "icon"')
                                            )
                                            ->where('measurements.device_id',$arr[$i]['device_id'])
                                            ->orderBy('longitude', 'DESC')
                                            ->limit(1)
                                            ->get();
            }

        return response($lately);
    }
}
