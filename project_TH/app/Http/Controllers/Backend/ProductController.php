<?php

namespace App\Http\Controllers\Backend;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brandname;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $products = Product::paginate(5);
        return view("backend.products.index",[
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brandnames = Brandname::all();
        return view("backend.products.create",[
            'categories' => $categories,
            'brandnames' => $brandnames
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->get('name', null);
        $product->origin_price = $request->get('origin_price', null);
        $product->sale_price = $request->get('sale_price', null);
        $product->content = $request->get('content', null);
        $product->category_id = $request->get('category_id', null);
        $product->status = $request->get('status', null);
        $product->guarantee = $request->get('guarantee', null);
        $product->policy = $request->get('policy', null);
        $product->brandname_id = $request->get('brandname_id', null);
        $product->save();
        return redirect()->route('backend.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        dd($product->category); // quan he 1 1
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

    public function showImages($id){
        $product = Product::find($id);
        // dd($product);
        // dd($product->images); // Lay ra tat ca anh cua san pham co id = $id
        $images = $product->images;
        return view("backend.products.showImages",[
            'images' => $images
        ]);
    }
}
