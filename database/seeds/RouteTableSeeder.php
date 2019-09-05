<?php

use Illuminate\Database\Seeder;
use App\Models\Route;


class RouteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $route = Route::create([
            'departure' => 'Banyuwangi',
            'destination'=> 'Malang',
            'time_departure' => '07:00',
            'meeting_point' => 'Rumah Makan Geprek Rogojampi'
        ]);
        $route = Route::create([
            'departure' => 'Banyuwangi',
            'destination'=> 'Jember',
            'time_departure' => '07:00',
            'meeting_point' => 'Rumah Makan Geprek Rogojampi'
        ]);
        $route = Route::create([
            'departure' => 'Banyuwangi',
            'destination'=> 'Surabaya',
            'time_departure' => '07:00',
            'meeting_point' => 'Rumah Makan Geprek Rogojampi'
        ]);
        $route = Route::create([
            'departure' => 'Banyuwangi',
            'destination'=> 'Situbondo',
            'time_departure' => '07:00',
            'meeting_point' => 'Rumah Makan Geprek Rogojampi'
        ]);
    }
}
