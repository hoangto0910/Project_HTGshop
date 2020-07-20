<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table ='categories';

    public function products(){
    	return $this->hasMany(Product::class); // Fk category_id lc id.product 
    }

    public static function data_tree($categories, $parent_id = 0, $level = 0){
    	$result = [];
    	foreach($categories as $key => $category){
    		if ($category['parent_id'] == $parent_id) {
    			$category['level'] = $level;
    			$result[] = $category;
    			unset($categories[$key]);
    			$child = Category::data_tree($categories, $category['id'], $level + 1);
    			$result = array_merge($result, $child);
    		}
    	}
    	return $result;
    }
}
