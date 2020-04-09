<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Medicine;
use Faker\Generator as Faker;

$factory->define(Medicine::class, function (Faker $faker) {
    return [
      'name' => $faker->name,
      'type' => rand(0,1) ? 'Liquid':'Capsules',
      'created_at' => now(),
 ];
});
