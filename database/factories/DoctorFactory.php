<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Doctor;
use Faker\Generator as Faker;

$factory->define(Doctor::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'national_id' => Str::random(10),
        'created_at' => now(),
        'is_ban' => rand(0,1) ? true : false,
        'pharmacy_id' =>  rand(1,18),
    ];
});
