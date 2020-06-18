<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->truncate();
        DB::table('images')->insert([
        	'id' => 1,
        	'name' => "HeadPhone asus 1",
        	'product_id' => 1,
        	'path' => asset('images/headPhoneasus1.jpg')
        ]);
        DB::table('images')->insert([
        	'id' => 2,
        	'name' => "HeadPhone asus 2",
        	'product_id' => 1,
        	'path' => asset('images/headPhoneasus2.jpg')
        ]);
        DB::table('images')->insert([
        	'id' => 3,
        	'name' => "HeadPhone asus 3",
        	'product_id' => 1,
        	'path' => asset('images/headPhoneasus2.jpg')
        ]);
        DB::table('images')->insert([
        	'id' => 4,
        	'name' => "Mouse Logitech 1",
        	'product_id' => 2,
        	'path' => asset('images/mouseLogitech1.jpg')
        ]);
        DB::table('images')->insert([
        	'id' => 5,
        	'name' => "Mouse Logitech 2",
        	'product_id' => 2,
        	'path' => asset('images/mouseLogitech2.jpg')
        ]);
        DB::table('images')->insert([
        	'id' => 6,
        	'name' => "Mouse Logitech 3",
        	'product_id' => 2,
        	'path' => asset('images/mouseLogitech3.jpg')
        ]);
    }
}
