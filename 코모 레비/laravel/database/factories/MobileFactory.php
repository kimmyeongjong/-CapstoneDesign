<?php

use Faker\Generator as Faker;


$factory->define(App\Measurement::class, function (Faker $faker) {
    return [
        'device_id' => 2,
        'ultrafine_dust' => random_int(1,200),
        'fine_dust' => random_int(1,200),
        'temperature' => random_int(1,50),
        'humidity' => random_int(1,200),
        'latitude' => random_int(1,90),
        'longitude' => random_int(1,180),
    ];
});
