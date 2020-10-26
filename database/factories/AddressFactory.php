<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use App\Area;
use App\Client;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
  return [
    'street_name' => $faker->streetName,
    'building_name' => $faker->address,
    'floor_number' => rand(0, 25),
    'flat_number' => rand(0, 25),
    'is_main' => rand(0, 1) ? true : false,
    'user_id' => Client::inRandomOrder()->first()->id,
    'area_id' => Area::inRandomOrder()->first()->id,
  ];
});
