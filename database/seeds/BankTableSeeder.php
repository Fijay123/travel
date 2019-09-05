<?php

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bank = Bank::create([
            'bank_name' => 'BNI No Rek 143-00-120372',
            'account_name'=> 'Barokah Travel',
            'account_number' => '123456789'
        ]);

        $bank = Bank::create([
            'bank_name' => 'BRI No Rek 2514-27-217',
            'account_name'=> 'Barokah Travel',
            'account_number' => '968697916131'
        ]);

        $bank = Bank::create([
            'bank_name' => 'MANDIRI No Rek 2635-127023', 
            'account_name'=> 'Barokah Travel',
            'account_number' => '96643435767'
        ]);

        $bank = Bank::create([
            'bank_name' => 'BCA No Rek 26516-28277',
            'account_name'=> 'Barokah Travel',
            'account_number' => '34567890'
        ]);
    }
}
