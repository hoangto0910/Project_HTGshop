<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function products(){
    	return $this->belongsToMany(Product::class, 'order_product');
    }

    public const STATUS = [
    	'huyhang' => 0,
    	'dathang' => 1,
    	'danggiaohang' => 2,
    	'dagiaohang' => 3,
    	'trahang' => 4
    ];
}
