<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    // public function user_info(){
    // 	return $this->hasOne(User_info::class);
    // }
    public function user_info(){
    	return $this->hasOne(User_info::class, 'user_id', 'id');
    }

    public function products(){
    	return $this->hasMany(Product::class); // Lk : id.user Fk : user_id
    }
}
