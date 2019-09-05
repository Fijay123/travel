<?php

use Illuminate\Database\Seeder;
Use App\Models\Car;

class CarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $car = Car::create([
            'police_number' => 'N 7687 UE',
            'type'=> 'Isuzu Elf Long',
            'seat' => '22'
        ]);

        $car = Car::create([
            'police_number' => 'W 7987 UY',
            'type'=> 'Isuzu Elf Long',
            'seat' => '22'
        ]);

        $car = Car::create([
            'police_number' => 'L 9087 UX',
            'type'=> 'Isuzu Elf Short',
            'seat' => '15'
        ]);

        $car = Car::create([
            'police_number' => 'S 9856 UP',
            'type'=> 'Isuzu Elf Short',
            'seat' => '15'
        ]);

    }
}
