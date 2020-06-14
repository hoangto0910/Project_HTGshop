<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('products')->truncate();
        for($i = 0;$i < 20; $i++){
            DB::table('products')->insert([
                'name' => "Products $i",
                'slug' => "products-$i",
                'origin_price' => $i,
                'sale_price' => (500000 + $i),
                'discount_percent' =>null,
                'content' => "Content products " . ($i + 1),
                'user_id' => ($i+1),
                'category_id' => ($i+1),
                'status' => rand($i, 3),
                // 'tag_id' => 1,
                'guarantee' =>($i + 2) . "Tháng",
                'policy' => null,
                'created_at' => '2020-05-' . ($i + 1) . ' 15:06:10'
            ]);
        }
    }
}
