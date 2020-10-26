<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\Pharmacy;
use App\Client;
use App\Doctor;
use App\Address;

use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $status = ['New', 'Processing', 'WaitingForUserConfirmation', 'Canceled', 'Confirmed', 'Delivered'];

    return [
        'delivering_address' => Address::inRandomOrder()->first()->id,
        'created_by' => rand(0, 1) ? 'Pharmacy' : 'Doctor',
        'status' => $status[rand(0, 5)],
        'total_price' => rand(0, 1000),
        'pharmacy_id' => Pharmacy::inRandomOrder()->first()->id,
        'user_id' => Client::inRandomOrder()->first()->id,
        'doctor_id' => Doctor::inRandomOrder()->first()->id,
    ];
});
