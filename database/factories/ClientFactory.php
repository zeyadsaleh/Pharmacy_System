<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
      'name' => $faker->name,
      'gender' => rand(0,1) ? 'Male':'Female',
      'national_id' => Str::random(10),
      'is_insured' => rand(0,1) ? true : false,
    ];
});
