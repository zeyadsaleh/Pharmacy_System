<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pharmacy;
use Faker\Generator as Faker;

$factory->define(Pharmacy::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'national_id' => Str::random(10),
        'area_id' =>  1
    ];
});
