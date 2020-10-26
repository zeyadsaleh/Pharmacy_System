<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(AreaTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(PharmacyTableSeeder::class);
        $this->call(DoctorTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(AddressTableSeeder::class);
        $this->call(OrderTableSeeder::class);
        $this->call(MedicineTableSeeder::class);
        $this->call(OrderMedicineTableSeeder::class);
    }
}
