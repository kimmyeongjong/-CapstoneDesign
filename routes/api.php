<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/auth/login','WebAppLoginController@login'); //로그인

Route::post('/auth/signup','WebAppLoginController@signUp'); //회원가입

Route::post('sensordata','SensorDataController@Measurements_info'); //측정정보 받기

Route::get('auth/area', 'ManagementController@area'); //구역정보 및 전체 통계

Route::get('auth/location/{select}', 'ManagementController@location'); //구역 위도 및 경도

Route::get('auth/time/{start_time}', 'ManagementController@time_area'); //관리구역 시간대별

Route::get('auth/errorCount','ManagementController@errorList'); //에러 기기 수 출력

Route::get('auth/myDevices/{select}','ManagementController@myDevice'); //해당 관리자의 모든 기기 정보 출력

Route::get('auth/device/{id}','ManagementController@deviceInfo'); //선택된 기기 정보 출력

Route::get('auth/statistics/{id}', 'ManagementController@statistics'); //각 기기의 통계 정보

Route::get('auth/measurements/{select}', 'MobileMeasurementController@measurements'); //사용자의 전체 측정정보 데이터(모바일)

Route::get('auth/time_date/{select}','MobileMeasurementController@time_date'); //날짜별 묶음의 데이터(모바일)

Route::get('auth/lately_date/{select}', 'MobileMeasurementController@lately_data'); //사용자의 가장 최근의 데이터 표시(모바일)

Route::get('auth/all_devices/{select}', 'MobileMeasurementController@all_devices_info'); //가장 최근의 모든 기기 위치 / 정보 표시(모바일)

Route::get('/test/gogo','TestController@test');