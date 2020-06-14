<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        DB::table('categories')->insert([
        	'name' => 'Linh Kiện máy tính',
            'slug' => 'linh-kien-may-tinh',
            'parent_id' => 1,
            'depth' => 1
        ]);
        DB::table('categories')->insert([
        	'name' => 'Phụ kiện điện tử',
            'slug' => 'phu-kien-dien-tu',
            'parent_id' => 1,
            'depth' => 1
        ]);
        DB::table('categories')->insert([
        	'name' => 'Gaming Gear',
            'slug' => 'gaming-gear',
            'parent_id' => 1,
            'depth' => 1
        ]);
        DB::table('categories')->insert([
        	'name' => 'PC nguyên bộ',
            'slug' => 'pc-nguyen-bo',
            'parent_id' => 1,
            'depth' => 1
        ]);
        DB::table('categories')->insert([
            'name' => 'Đồ chơi công nghệ',
            'slug' => 'do-choi-cong-nghe',
            'parent_id' => 1,
            'depth' => 1
        ]);
        DB::table('categories')->insert([
            'name' => 'Máy Điện tử console',
            'slug' => 'may-dien-tu-console',
            'parent_id' => 1,
            'depth' => 1
        ]);
    }
}
