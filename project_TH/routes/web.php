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
    // Quản lý kho 
    Route::get('stockIndex', "ProductController@stockIndex")->name('backend.product.stockindex');
    Route::get('addQuantity/{id}', "ProductController@addQuantity")->name('backend.product.addQuantity');
    Route::put('storeQuantity/{id}', "ProductController@storeQuantity")->name('backend.product.storeQuantity');
    //anh san pham
    Route::get('addImages/{id}', 'ProductController@addImages')->name('backend.product.addimages');
    Route::post('storeImages/{id}', 'ProductController@storeImages')->name('backend.product.storeimages');
    Route::delete('destroy/{id}', 'ProductController@destroy')->name('backend.product.destroy');
    Route::get('editImage/{id}', 'ProductController@editImage')->name('backend.product.editImage');
    Route::put('store_image/{id}', 'ProductController@store_image')->name('backend.product.store_image');
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
    //test ss
    Route::get('session', 'UserController@test_session');
    Route::get('get', 'UserController@getSession');
    Route::get('cookie', 'UserController@cookie');
    Route::get('getcookie', 'UserController@getCookie');
    Route::get('cache', 'UserController@cache');

    //up xong xoa
    Route::get('uploadImage', function(){
      return view('backend.users.uploadImage');
    });
    Route::post('addImage', "UserController@addImage")->name('backend.user.addImage');
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
    Route::get('/', "OrderController@index")->name('backend.order.index');
    Route::get('Showdetail/{id}', "OrderController@showDetail")->name('backend.order.showDetail');
    Route::delete('destroyOrder_product/{id}/{order_id}', "OrderController@destroyOrder_product")->name('backend.order.destroyOrder_product');
    Route::get('success/{id}', "OrderController@success")->name('backend.order.success');
    Route::get('editOrder{id}', 'OrderController@editOrder')->name('backend.order.editOrder');
    Route::put('updateOrder{id}', 'OrderController@updateOrder')->name('backend.order.updateOrder');
    // Chi tiết từng loại order
    Route::get('orderProcess', 'OrderController@orderProcess')->name('backend.order.orderProcess');
    Route::get('orderSuccess', "OrderController@orderSuccess")->name('backend.order.orderSuccess');
    Route::get('orderToday', "OrderController@orderToday")->name('backend.order.orderToday');
  });
});
// store ajax
  Route::post('storeajax', "Backend\UserController@storeAjax")->name('backend.user.storeajax');

Auth::routes();
//Quản lý Authentication
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function(){
  Route::get('login', 'LoginController@showLoginForm')->name('login');
  Route::post('login', 'LoginController@Login')->name('login');
  Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
  Route::post('register', 'RegisterController@register')->name('register');
  Route::post('logout', 'LoginController@logout')->name('logout');
});
Route::get('/home', 'HomeController@index')->name('home.index')->middleware('auth');
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
  Route::get('showProductsCategory/{id}', "HomeController@showProductsCategory")->name("frontend.home.showProductsCategory");
  // Login / Register
  Route::post('login', "LoginController@login")->name('frontend.home.login');
  Route::post('logout', "loginController@logout")->name('frontend.home.logout');
  // // store ajax
  // Route::post('storeajax', "HomeController@storeAjax")->name('frontend.home.storeajax');
  // Cart
  Route::get('cart', "CartController@index")->name('frontend.cart.index');
  Route::get('cartAdd/{id}', "CartController@add")->name('frontend.cart.add');
  Route::get('cartDestroy/{id}', "CartController@destroy")->name('frontend.cart.destroy');
  Route::get('plusQuantity/{rowId}/{qty}', "CartController@plusQuantity")->name('frontend.cart.plusQuantity');
  Route::get('decreaseQuantity/{rowId}/{qty}', "CartController@decreaseQuantity")->name('frontend.cart.decreaseQuantity');
  Route::get('viewCheckOut', 'CartController@viewCheckOut')->name('frontend.cart.viewCheckOut');
  Route::post('checkOut', 'CartController@checkOut')->name('frontend.cart.checkOut');
  Route::get('checkOutSuccess', 'CartController@checkOutSuccess')->name('frontend.cart.checkOutSuccess');
  // Wishlist
  Route::get('wishlist', 'HomeController@wishlist')->name('frontend.home.wishlist');
  Route::get('addWishlist/{id}', 'HomeController@addWishlist')->name('frontend.home.addWishlist');
  // ProfileUser
  Route::get('userProfile', "HomeController@userProfile")->name('frontend.home.userProfile');
  Route::get('editProfile', "HomeController@editProfile")->name('frontend.home.editProfile');
  Route::put('storeUser/{id}', "HomeController@storeUser")->name('frontend.home.storeUser');
  Route::get('cancelOrder/{id}', "HomeController@cancelOrder")->name('frontend.home.cancelOrder');
  //Filter
  Route::get('Filter', "HomeController@filter")->name('frontend.home.filter');
});

//9 
Route::get('testuser', "Backend\UserInfoController@index");
Route::get('showproduct/{id}', "Backend\CategoryController@show");
Route::get('testshow/{id}', "Backend\ProductController@show");
// Route::get('edit/{product}', function(\App\Models\Product $product){
//   dd('co');
//   return view('backend.products.edit',['product' => $product]);
// })->name('backend.product.edit')->middleware('can:update,product');

