<?php

namespace App\Http\Controllers\Backend;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brandname;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Validator;

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
            'brandnames' => $brandnames,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        // $validate = $request->validate([
        //     'name' => ['required', 'min:8', 'max:10'],
        //     'origin_price' => ['required', 'numeric'],
        //     'sale_price' => ['required', 'numeric'],
        //     'content' => ['required'],
        //     'status' => ['required']
        // ]);

        // $validator = Validator::make($request->all(),
        //     [
        //         'name' => ['required', 'min:8', 'max:10'],
        //         'origin_price' => ['required', 'numeric'],
        //         'sale_price' => ['required', 'numeric'],
        //         'content' => ['required'],
        //         'status' => ['required']
        //     ],
        //     [
        //         'required' => ':attribute Không được để trống',
        //         'min' => ':attribute Phải lớn hơn :min',
        //         'max' => ':attribute Phải ít hơn :max',
        //         'numeric' => ':attribute Phải là dạng số'
        //     ],
        //     [
        //         'name' => 'Tên sản phẩm',
        //         'origin_price' => 'Giá gốc',
        //         'sale_price' => 'Giá bán',
        //         'content' => 'mô tả sản phẩm',
        //     ],
        // );

        // dd($validator);
        // if ($validator->errors()) {
        //     return back()->withErrors($validator)->withInput();
        // }

        $product = new Product(); // Tao 1 doi tuong model Product -> $product co het thuoc tinh la cac key (truong cua bang)
        $product->name = $request->get('name', null);
        $product->origin_price = $request->get('origin_price', null);
        $product->sale_price = $request->get('sale_price', null);
        $product->content = $request->get('content', null);
        if (Auth::check()) {
            $product->user_id = Auth::user()->id;
        }else{
            $product->user_id = null;
        }
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
        $categories = Category::all();
        $brandnames = Brandname::all();
        $product = Product::find($id);
        return view('backend.products.edit',[
            'categories' => $categories,
            'brandnames' => $brandnames,
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->get('name');
        $product->origin_price = $request->get('origin_price');
        $product->sale_price = $request->get('sale_price');
        $product->content = $request->get('content');
        $product->category_id = $request->get('category_id');
        $product->brandname_id = $request->get('brandname_id');
        $product->status = $request->get('status');
        $product->guarantee = $request->get('guarantee');
        $product->policy = $request->get('policy');
        $product->user_id = Auth::user()->id;
        $product->save();
        return redirect()->route('backend.product.index');
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
    // Thêm ảnh cho sản phẩm
    public function addImages($id){

    }
}
