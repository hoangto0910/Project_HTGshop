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
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('admins')) {
            $products = Product::orderBy('updated_at', 'desc')->paginate(5);
        // $products = Product::paginate(5);
        // dd($products);
            return view("backend.products.index",[
                'products' => $products,
            ]);
        }else{
            return abort('403');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('admins')) {
            // dd('co');
            $categories = Category::all();
            $brandnames = Brandname::all();
            return view("backend.products.create",[
                'categories' => $categories,
                'brandnames' => $brandnames,
            ]);
        }else{
            return abort('403');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // StoreProduct
    {
        $key = $request->key;
        $value = $request->value;
        $config = array_combine($key, $value);
        // dd($config);
        // $jsons = ;
        // // dd(json_decode($jsons));
        // foreach (json_decode($jsons) as $key => $value) {
        //    echo $key . "=" . $value .  "<br>";
        // }
        // die();
        if (Gate::allows('admins')) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $nameFile = $image->getClientOriginalName();
                $url = Storage::url($nameFile);
            // dd($url);
                Storage::disk('public')->putFileAs('', $image, $nameFile);
            }else{
                dd('khong co anh');
            }

        $product = new Product(); // Tao 1 doi tuong model Product -> $product co het thuoc tinh la cac key (truong cua bang)
        $product->name = $request->get('name', null);
        $product->image = $url;
        $product->image_name = $nameFile;
        $product->origin_price = $request->get('origin_price', null);
        $product->sale_price = $request->get('sale_price', null);
        $product->quantity = 0; // mặc định số lượng là 0
        $product->content = $request->get('content', null);
        // Luu Json
        $product->config = json_encode($config);
        // dd($product->config);
        // $product->config = $request->get('config', null);
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
        $save = $product->save();
        $save = 1;
        if ($save) {
            $request->session()->flash('success', 'created success');
        }else{
            $request->session()->flash('error', 'created fail');
        }
        return redirect()->route('backend.product.index');
    }else{
        return abort('403');
    }
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
    // $product phan quyen middleware sau $id
    {
        $product = Product::find($id);
        // dd(json_decode($product->config));
        // dd(json_decode($product->config));

        // // Policies
        // $user = Auth::user();
        // // dd($user);
        // if ($user->can('update', $product)) {
        //     dd("co");
        // }else{
        //     dd("khong");
        // }

        if (Gate::allows('update-product', $product)){ //check user dang login
            $categories = Category::all();
            $brandnames = Brandname::all();
            return view('backend.products.edit',[
                'categories' => $categories,
                'brandnames' => $brandnames,
                'product' => $product
            ]);
        }else{
            return abort('403');
        }
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
        // dd(json_encode($request->config));
        // dd($request->key);
        $key = $request->key;
        $value = $request->value;
        $config = array_combine($key, $value);
        // dd($config);
        $product = Product::find($id);
        if (Gate::allows('update-product', $product)){
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $nameFile = $image->getClientOriginalName();
                $url = Storage::url($nameFile);
            // dd($url);
                Storage::disk('public')->putFileAs('', $image, $nameFile);
                $product->image = $url;
                $product->image_name = $nameFile;
            }
            $product->name = $request->get('name');
            $product->origin_price = $request->get('origin_price');
            $product->sale_price = $request->get('sale_price');
            $product->content = $request->get('content');
            $product->config = json_encode($config);
            $product->category_id = $request->get('category_id');
            $product->brandname_id = $request->get('brandname_id');
            $product->status = $request->get('status');
            $product->guarantee = $request->get('guarantee');
            $product->policy = $request->get('policy');
            $product->user_id = Auth::user()->id;
            $product->save();
            return redirect()->route('backend.product.index');
        }else{
            return abort('403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('admins')) {
            $product = Product::find($id);
            // dd($product->image_name);
            // dd(__DIR__ . "/" . $product->image_name);
            // dd(Storage::disk('public')->delete($product->image_name));
            if (Storage::disk('public')->exists($product->image_name)) {
                Storage::disk('public')->delete($product->image_name);
            }
            $product->delete();
            return redirect()->route('backend.product.index');
        }else{
            return abort('403');
        }
        
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

        $validate = $request->validate([
            "images" => ['required',]
        ]);

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

    public function editImage($id){
        $image = Image::find($id);
        return view('backend.products.editImage', [
            'image' => $image
        ]);
    }

    public function store_image(Request $request, $id){
        // dd(Image::find($id));
        // dd($request->hasFile('image'));
        if ($request->hasFile('image')) {
            $image_info = $request->file('image');
            // dd($image_info);
            $nameFile = $image_info->getClientOriginalName();
            // dd($nameFile);
            $url = Storage::url($nameFile);
            // dd($url);
            Storage::disk('public')->putFileAs('', $image_info, $nameFile);
        }else{
            dd('Chua co anh');
        }
        $image = Image::find($id);
        if (Storage::disk('public')->exists($image->name)) {
            Storage::disk('public')->delete($image->name);
            // dd('xoa thanh cong');
        }
        $product_id = $image->product_id;
        $image->name = $nameFile;
        $image->path = $url;
        $image->save();
        return redirect()->route("backend.product.showImages", $product_id);
    }
    //

    //Quản lý kho
    public function stockIndex(){
        $products = Product::orderBy('updated_at', 'DESC')->get();
        // dd($products);
        return view('backend.products.stockIndex',[
            'products' => $products
        ]);
    }

    public function addQuantity($id){
        // dd($id);
        $product = Product::find($id);
        return view('backend.products.addQuantity', [
            'product' => $product
        ]);
    }

    public function storeQuantity(Request $request, $id){
        $validate = $request->validate([
            'quantity' => ['required', 'numeric'],
            'origin_price' => ['required', 'numeric'],
            'sale_price' => ['required', 'numeric'],
        ]);
        $product = Product::find($id);
        // dd($product);
        $product->quantity = $product->quantity + $request->get('quantity');
        // dd($product->quantity);
        $product->status = $request->status;
        $product->origin_price = $request->get('origin_price');
        $product->sale_price = $request->get('sale_price');
        $product->save();
        return redirect()->route('backend.product.stockindex');
    }
}
