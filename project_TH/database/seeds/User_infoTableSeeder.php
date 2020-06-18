<?php

use Illuminate\Database\Seeder;

class User_infoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('user_info')->truncate();
    	for ($i=1; $i < 5; $i++) { 
    		DB::table('user_info')->insert([
    			'user_id' => $i,
    			'name' => "Username" . $i,
                'phone' => "09999999",
                'address' => "address " . $i,
            ]);
    	}

    }
}
