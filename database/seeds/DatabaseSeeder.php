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
        $this->call(UserTableSeeder::class);
        $this->call(BankTableSeeder::class);
        $this->call(CarTableSeeder::class);
        $this->call(DriverTableSeeder::class);
        $this->call(RouteTableSeeder::class);

    }
}
