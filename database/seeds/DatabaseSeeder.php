<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = '21';
        $latitude = '35.8959380';
        $longitude = '128.6235480';
        $date = '2019-05-11';

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 00:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 00:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 01:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 01:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 02:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 02:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 03:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 03:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 04:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 04:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 05:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 05:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 06:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 06:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 07:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 07:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 08:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 08:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 09:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 09:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 10:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 10:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 11:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 11:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 12:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 12:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 13:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 13:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 14:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 14:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 15:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 15:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 16:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 16:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 17:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 17:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 18:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 18:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 19:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 19:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 20:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 20:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 21:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 21:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 22:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 22:30:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 23:00:00'
        ]);

        DB::table('measurements')->insert([
            'device_id' => $id,
            'ultrafine_dust' => random_int(1,100),
            'fine_dust' => random_int(1,200),
            'temperature' => random_int(1,50),
            'humidity' => random_int(1,100),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'measurements_time' => $date.' 23:30:00'
        ]);
    }
}