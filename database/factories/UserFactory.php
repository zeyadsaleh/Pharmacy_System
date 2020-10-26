<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Client;
use App\Doctor;
use App\Pharmacy;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $profile_types = ['App\Client','App\Pharmacy','App\Doctor'];
    $profile_type = $profile_types[rand(0,2)];

    if($profile_type == 'App\Client'){
        $profile_id = Client::inRandomOrder()->first()->id;
    }elseif($profile_type == 'App\Pharmacy'){
        $profile_id = Pharmacy::inRandomOrder()->first()->id;
    }else{
        $profile_id = Doctor::inRandomOrder()->first()->id;
    }

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'profile_id' => $profile_id,
        'profile_type' => rand(0,1) ? 'App\Pharmacy':'App\Doctor',
    ];
});
