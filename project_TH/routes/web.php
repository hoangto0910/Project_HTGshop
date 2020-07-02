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
    Route::get('show/{id}', 'ProductController@show')->name('backend.product.show');
    Route::get('/showImages/{id}', 'ProductController@showImages')->name('backend.product.showImages');
    Route::get('edit/{product}', 'ProductController@edit')->name('backend.product.edit');
    // ->middleware('can:update,product');
    Route::put('update/{id}', 'ProductController@update')->name('backend.product.update');
    //anh san pham
    Route::get('addImages/{id}', 'ProductController@addImages')->name('backend.product.addimages');
    Route::post('storeImages/{id}', 'ProductController@storeImages')->name('backend.product.storeimages');
    Route::delete('destroy/{id}', 'ProductController@destroy')->name('backend.product.destroy');
  });
    // Quản lý user
  Route::group(['prefix' => 'users'], function(){
    Route::get('/', 'UserController@index')->name('backend.user.index');
    Route::get('/create', 'UserController@create')->name('backend.user.create');
    Route::get('/showProducts/{user_id}', "UserController@showProducts")->name('backend.user.showProducts');
    Route::post('store', 'UserController@store')->name('backend.user.store');
    Route::get('edit/{id}', 'UserController@edit')->name('backend.user.edit');
    Route::put('update/{id}', 'UserController@update')->name('backend.user.update');
    Route::delete('destroy/{id}', 'UserController@destroy')->name('backend.user.destroy');
  });
    // Quản lý Category
  Route::group(['prefix' => 'categories'], function(){
    Route::get('/' , "CategoryController@index")->name("backend.category.index");
    Route::get('/showProducts/{category_id}', "CategoryController@showProducts")->name('backend.category.showProducts');
    Route::get('create', 'CategoryController@create')->name('backend.category.create');
    Route::post('store', 'CategoryController@store')->name('backend.category.store');
    Route::get('edit/{id}', 'CategoryController@edit')->name('backend.category.edit');
    Route::put('update/{id}', 'CategoryController@update')->name('backend.category.update');
    Route::delete('destroy/{id}', 'CategoryController@destroy')->name('backend.category.destroy');
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
  Route::get("categories", "HomeController@showCategories")->name("frontend.home.showCategories");
  Route::get('showproduct/{id}', "HomeController@showProduct")->name("frontend.home.showProduct");
});


//9 
Route::get('testuser', "Backend\UserInfoController@index");
Route::get('showproduct/{id}', "Backend\CategoryController@show");
Route::get('testshow/{id}', "Backend\ProductController@show");
// Route::get('edit/{product}', function(\App\Models\Product $product){
//   dd('co');
//   return view('backend.products.edit',['product' => $product]);
// })->name('backend.product.edit')->middleware('can:update,product');

