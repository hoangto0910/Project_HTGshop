<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Quản lý chức năng backend
Route::group([
  'namespace' => 'Backend',
  'prefix' => 'admin',
  'middleware' => 'auth'
], function (){
    // Trang dashboard - trang chủ admin
  Route::get('/dashboard', 'DashboardController@index')->name('backend.dashboard');
    // Quản lý sản phẩm
  Route::group(['prefix' => 'products'], function(){
    Route::get('/', 'ProductController@index')->name('backend.product.index');
    Route::get('/create', 'ProductController@create')->name('backend.product.create');
    Route::post('/store', 'ProductController@store')->name('backend.product.store');
    Route::get('/showImages/{id}', 'ProductController@showImages')->name('backend.product.showImages');
  });
    // Quản lý user
  Route::group(['prefix' => 'users'], function(){
    Route::get('/', 'UserController@index')->name('backend.user.index');
    Route::get('/create', 'UserController@create')->name('backend.user.create');
    Route::get('/showProducts/{user_id}', "UserController@showProducts")->name('backend.user.showProducts');
  });
    // Quản lý Category
  Route::group(['prefix' => 'categories'], function(){
    Route::get('/' , "CategoryController@index")->name("backend.category.index");
    Route::get('/showProducts/{category_id}', "CategoryController@showProducts")->name('backend.category.showProducts');
  });
    // Quản lý Order
  Route::group(['prefix' => 'orders'], function(){
    Route::get('/showProducts/{id}', "OrderController@showProducts")->name('backend.order.showProducts');
  });
});

Auth::routes();
//Quản lý Authentication
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function(){
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@Login')->name('login');
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register')->name('register');
    Route::post('logout', 'LoginController@logout')->name('logout');
});
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
//

// Quản lý chức năng frontend
Route::group([
  'namespace' => 'Frontend',
  'prefix' => 'htgshop',
], function(){
  // Trang index frontend
  Route::get("/" , "HomeController@index")->name("frontend.home.index");
});


//9 
Route::get('testuser', "Backend\UserInfoController@index");
Route::get('showproduct/{id}', "Backend\CategoryController@show");
Route::get('testshow/{id}', "Backend\ProductController@show");


