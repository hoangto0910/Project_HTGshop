<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    protected $table = 'users';
    protected $fillable = [
        'name','email','password'
    ];

    // public function user_info(){
    // 	return $this->hasOne(User_info::class);
    // }
    public function user_info(){
    	return $this->hasOne(User_info::class, 'user_id', 'id');
    }

    public function products(){
    	return $this->hasMany(Product::class); // Lk : id.user Fk : user_id .
    }

    public const ROLE = [
        'admin' => 1,
        'content' => 2,
        'sale_person' => 3,
        'user' => 4
    ];
}
