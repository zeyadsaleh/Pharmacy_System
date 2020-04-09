<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pharmacy;
use Faker\Generator as Faker;

$factory->define(Pharmacy::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        // 'email' => $faker->unique()->safeEmail,
        // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'priority' => rand(1,5),
        'national_id' => Str::random(10),
        'area_id' =>  rand(1,18),
    ];
});
