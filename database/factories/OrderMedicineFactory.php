<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderMedicine;
use Faker\Generator as Faker;

$factory->define(OrderMedicine::class, function (Faker $faker) {
  return [
      'order_id' => rand(1, 10),
      'medicine_id' => rand(1, 10),
      'price' => rand(0, 1000),
      'quantity' => rand(1, 30),
  ];
});
