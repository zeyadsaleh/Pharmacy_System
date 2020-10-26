<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Medicine;
use Faker\Generator as Faker;

$factory->define(Medicine::class, function (Faker $faker) {
  $types = ['Injections', 'Drops', 'Capsules', 'Tablet', 'Liquid', 'Cream', 'Suppositories', 'Inhalers'];
    return [
      'name' => $faker->name,
      'type' => $types[rand(0,7)],
 ];
});
