<?php

use Illuminate\Database\Seeder;
use App\Models\Driver;

class DriverTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $driver = Driver::create([
            'name' => 'Sukidi',
            'driver_license' => '87523976',
            'telp' => '098674567356',
            'address'=> 'Jalan Rogojampi No. 4 Banyuwangi'
        ]);
        $driver = Driver::create([
            'name' => 'Darman',
            'driver_license' => '0852319',
            'telp' => '086978757532',
            'address'=> 'Jalan Licin No. 4 rembang'
        ]);
        $driver = Driver::create([
            'name' => 'Wilda',
            'driver_license' => '329759',
            'telp' => '0764865829',
            'address'=> 'Jalan Genteng Tendean No. 4 Banyuwangi'
        ]);
        $driver = Driver::create([
            'name' => 'Boden',
            'driver_license' => '237543',
            'telp' => '0872753722',
            'address'=> 'Jalan Jember No. 4 Jember'
        ]);
    }
}
