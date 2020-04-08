<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'delivering_address' => rand(1,10),
        'created_at' => now(),
        'created_by' => rand(0,1) ? 'Pharmacy':'Doctor',
        'status' => rand(0,1) ? 'New': 'Processing',
        'total_price' => rand(0,1000),
        'pharmacy_id' => rand(1,18),
        'user_id' => rand(1,18),
        'doctor_id' => rand(1,18),
    ];
});
