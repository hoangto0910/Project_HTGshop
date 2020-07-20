<?php

namespace App\Providers;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Gloudemans\Shoppingcart\Facades\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories =  Cache::remember('categories', 10, function(){
            return Category::all();
        });
        // $categories = Cache::get('categories');
        // $list_categories = Category::data_tree($categories, 0);
        $categories_parent = Category::where('depth', 0)->get();
        $categories_child = Category::where('depth', 1)->get();
        // $carts_dropdown = Cart::content();
        View::share([
            'categories' => $categories,
            'categories_parent' => $categories_parent,
            'categories_child' => $categories_child,
            // 'carts_dropdown' => $carts_dropdown
        ]);
        // $categories = Category::all();
        // View::share('categories', $categories, 120);
    }
}
