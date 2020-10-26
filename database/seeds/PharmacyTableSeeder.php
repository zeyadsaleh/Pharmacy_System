<?php

use Illuminate\Database\Seeder;
use App\Pharmacy;

class PharmacyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Pharmacy::class,30)->create();
    }
}
