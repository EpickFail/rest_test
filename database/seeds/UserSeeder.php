<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for ($i=0;$i<10;$i++) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
        
        for ($i=0;$i<30;$i++) {
            $random_Date = date("d.m.Y", rand(strtotime("Jan 01 2015"), strtotime("Nov 01 2022")));
            DB::table('reserves')->insert([
                'date_reserve' => $random_Date,
                'status' => random_int(0, 1),
                'id_user' => random_int(1, 10),
            ]);
        }

    }
}
