<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([      
            'email' => "Tohoang".'@gmail.com',
            'name' => "Dang To hoang",
            'phone' => "09999999",
            'address' => "addres",
            'role' => 1,
            'remember_token' => "null",
            'password' => "123123",
        ]);
        for($i = 1; $i < 10; $i++){
            DB::table('users')->insert([
                'email' => "admin".$i.'@gmail.com',
                'name' => "admin" . $i,
                'phone' => "09999999". $i,
                'address' => "addres" . $i,
                'role' => $i,
                'remember_token' => "token" . $i,
                'password' => "123123 " . $i,
            ]);
        }
    }
}
