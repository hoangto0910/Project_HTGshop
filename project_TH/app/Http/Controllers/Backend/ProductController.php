<?php

namespace App\Http\Controllers\Backend;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brandname;
use App\Models\Image;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
        foreach ($products as $product) {
            $productConfigs = json_decode($product->config);
        }
        // dd($products);
        $products = Product::paginate(5);
        return view("backend.products.index",[
            'products' => $products,
            'productConfigs' => $productConfigs
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
        //         'name' => ['required', 'min:8', 'max:30'],
        //         'origin_price' => ['required', 'numeric'],
        //         'sale_price' => ['required', 'numeric'],
        //         'content' => ['required'],
        //         'status' => ['required'],
        //         'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:10000'],
        //     ],
        //     [
        //         'required' => ':attribute Không được để trống',
        //         'min' => ':attribute Phải lớn hơn :min',
        //         'max' => ':attribute Phải ít hơn :max',
        //         'numeric' => ':attribute Phải là dạng số',
        //         'image' => 'Phải upload File có dạng là ảnh',
        //         'mimes' => ':attribute Phải có đuôi là : jpeg, png, jpg'
        //     ],
        //     [
        //         'name' => 'Tên sản phẩm',
        //         'origin_price' => 'Giá gốc',
        //         'sale_price' => 'Giá bán',
        //         'content' => 'mô tả sản phẩm',
        //         'image' => 'Ảnh'
        //     ],
        // );

        // // dd($validator);
        // if ($validator->errors()) {
        //     return back()->withErrors($validator)->withInput();
        // }
        
        // if ($request->hasFile('images')) {
        //    // $path = Storage::disk('public')->putFile('images3', $request->file('images'));
        //     $images = $request->file('images');
        //     dd($images);
        //     foreach ($images as $image) {
        //         # code...
        //     }
        // }else{
        //     dd('k co file');
        // }
    
        // $images = $request->file('images');
        // foreach ($images as $image) {
        //     $nameFile = $image->getClientOriginalName();
        //     $url = Storage::url($nameFile);
        //     dd($url);
        //     Storage::disk('public')->putFileAs('products', $image, $nameFile);
        // }

        // if ($request->hasFile('images')) {
        //    $images = $request->file('images');
        //    foreach ($images as $image) {
        //        $image->store('image');
        //    }
        // }else{
        //     dd('k co file');
        // }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $nameFile = $image->getClientOriginalName();
            $url = Storage::url($nameFile);
            Storage::disk('public')->putFileAs('', $image, $nameFile);
        }else{
            dd('khong co anh');
        }

        $product = new Product(); // Tao 1 doi tuong model Product -> $product co het thuoc tinh la cac key (truong cua bang)
        $product->name = $request->get('name', null);
        $product->image = $url;
        $product->origin_price = $request->get('origin_price', null);
        $product->sale_price = $request->get('sale_price', null);
        $product->content = $request->get('content', null);
        //Luu Json
        $product->config = json_encode($request->get('config', null));
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
        // dd($product);
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
        $productConfigs = json_decode($product->config);
        // dd($productConfigs);
        foreach ($productConfigs as $config) {
            echo $config->key . ":" . $config->value;
        }
        die();
        // echo $productconfig['key'] . ":" . $productconfig['value'] . "<br>";
        $product->config = [];
        foreach ($product->config as $key => $productconfig) {
            if (!is_null($productconfig['key'])) {
                $product->config[] = $productconfig;
            }
        }
        dd(json_encode($product->config));
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
        $product_id = $product->id;
        // dd($product_id);
        // dd($product);
        // dd($product->images); // Lay ra tat ca anh cua san pham co id = $id
        $images = $product->images;
        // dd($images);
        return view("backend.products.showImages",[
            'images' => $images,
            'product_id' => $product_id
        ]);
    }
    // Thêm ảnh cho sản phẩm
    public function addImages($id){
        $product_id = $id;
        return view('backend.products.addImages',[
            'product_id' => $product_id
        ]);
    }

    public function storeImages(Request $request, $id){
        $product_id = $id;
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $image_info = [];
            foreach ($images as $image) {
                $nameFile = $image->getClientOriginalName();
                $url = Storage::url($nameFile);
                Storage::disk('public')->putFileAs('', $image, $nameFile);
                $images_info[] = [
                    'url' => $url,
                    'nameFile' => $nameFile
                ];
            }
            foreach ($images_info as $info) {
                $product_image = new Image();
                $product_image->name = $info['nameFile'];
                $product_image->path = $info['url'];
                $product_image->product_id = $product_id;
                $product_image->save();
            }
            return redirect()->route('backend.product.showImages', $product_id);
        }
    }
}
