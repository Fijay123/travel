<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Saya Adalah Admin',
        	'email' => 'admin@travel.test',
            'password' => bcrypt(123456),
            'email_verified_at' => '2019-07-30',
            'address' => 'JL. Licin Banyuwangi',
            'phone' => '085633037905',
            'level' => '1'
        ]);

        $user = User::create([
            'name' => 'Ahmad Fijay Ramadhan',
        	'email' => 'ramadhanfijay@gmail.com',
            'password' => bcrypt(12345678),
            'email_verified_at' => '2019-07-30',
            'address' => 'Banyuwangi',
            'phone' => '085733035805',
            'level' => '0'
        ]);
    }
}
