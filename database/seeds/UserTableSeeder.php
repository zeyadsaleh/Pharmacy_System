<?php

use Illuminate\Database\Seeder;
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Client;
use App\Doctor;
use App\Pharmacy;

use Faker\Generator as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      foreach(Client::all() as $user){
        User::create([
          'name' => $faker->name,
          'email' => $faker->unique()->safeEmail,
          'email_verified_at' => now(),
          'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
          'remember_token' => Str::random(10),
          'profile_id' => $user->id,
          'profile_type' => 'App\Client'
        ]);
      }
      foreach(Doctor::all() as $doctor){
        User::create([
          'name' => $faker->name,
          'email' => $faker->unique()->safeEmail,
          'email_verified_at' => now(),
          'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
          'remember_token' => Str::random(10),
          'profile_id' => $doctor->id,
          'profile_type' => 'App\Doctor'
        ]);
      }
      foreach(Pharmacy::all() as $pharmacy){
        User::create([
          'name' => $faker->name,
          'email' => $faker->unique()->safeEmail,
          'email_verified_at' => now(),
          'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
          'remember_token' => Str::random(10),
          'profile_id' => $pharmacy->id,
          'profile_type' => 'App\Pharmacy'
        ]);
      }
    }
}
