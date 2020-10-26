<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderMedicine;
use App\Order;
use App\Medicine;
use Faker\Generator as Faker;

$factory->define(OrderMedicine::class, function (Faker $faker) {
  return [
      'order_id' => Order::inRandomOrder()->first()->id,
      'medicine_id' => Medicine::inRandomOrder()->first()->id,
      'price' => rand(0, 1000),
      'quantity' => rand(1, 30),
  ];
});
