<?php

namespace App\Http\Controllers\frontend;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topsell_product = Product::orderby('count_bought', 'desc')->take(5)->get();
        // $new_products = Product::orderby('count_bought', 'desc')->take(4)->get();
        $new_products = Product::orderby('created_at', 'desc')->take(5)->get();
        // dd($new_products);
        return view("frontend.home.homeIndex", [
            'topsell_product' => $topsell_product,
            'new_products' => $new_products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showCategories(){
        $categories = Category::all();
        return view('frontend.home.showCategory',[
            'categories' => $categories
        ]);
    }

    public function showProduct($id){
        $product = Product::find($id);
        $product_images = $product->images;
        // dd($product_images);
        return view('frontend.home.showProduct', [
            'product' => $product,
            'product_images' => $product_images
        ]);
    }

}
