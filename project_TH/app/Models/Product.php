<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function category(){
    	return $this->belongsTo(Category::class);
    }

    public function images(){
    	return $this->hasMany(Image::class); // Fk la product_id Lk la id
    }

    public function orders(){
    	return $this->belongsToMany(Order::class);
    }
}
