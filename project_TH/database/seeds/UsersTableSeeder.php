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
            'role' => 1,
            'user_id' => 1,
            'remember_token' => "null",
            'password' => "123123",
        ]);
        for($i = 2; $i < 10; $i++){
            DB::table('users')->insert([
                'email' => "admin".$i.'@gmail.com',
                'role' => $i,
                'user_id' => $i,
                'remember_token' => "token" . $i,
                'password' => "123123 " . $i,
            ]);
        }
    }
}
