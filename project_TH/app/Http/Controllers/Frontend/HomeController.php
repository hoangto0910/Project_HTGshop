<?php

namespace App\Http\Controllers\frontend;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order_product;
use App\Models\Order;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::all();
        // $categories_parent = Category::where('depth', 0)->get();
        // dd($categories_parent);
        // $categories_child = Category::where('depth', 1)->get();
        // dd($categories_child);
        // dd($categories);
        // $list_categories = Category::data_tree($categories, 0);
        // dd($list_categories);
        $topview_products = Product::orderBy('view_count', 'desc')->take(5)->get();
        $topsell_products = Product::orderby('count_bought', 'desc')->take(5)->get();
        // $new_products = Product::orderby('count_bought', 'desc')->take(4)->get();
        $new_products = Product::orderby('created_at', 'desc')->take(5)->get();
        $random_products = Product::inRandomOrder()->take(5)->get();
        // dd($random_products);
        // dd($new_products);
        return view("frontend.home.homeIndex", [
            'topsell_products' => $topsell_products,
            'new_products' => $new_products,
            'random_products' => $random_products,
            'topview_products' => $topview_products
            // 'categories_parent' => $categories_parent,
            // 'categories_child' => $categories_child
            // 'categories' => $categories
            // 'list_categories' => $list_categories
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

    public function showProduct($id){
        // $categories = Category::all();
        // $list_categories = Category::data_tree($categories, 0);
        $product = Product::find($id);
        $product->view_count = $product->view_count + 1;
        $product->save();
        // dd($product);
        $product_bot = Product::where("category_id", "$product->category_id")->take(4)->get();
        // dd($product_bot);
        $product_images = $product->images;
        // dd($product_images);
        return view('frontend.home.showProduct', [
            'product' => $product,
            // 'list_categories' => $list_categories,
            'product_images' => $product_images,
            'product_bot' => $product_bot
        ]);
    }

    public function showProductsCategory($id){
        // $categories = Category::all();
        // $list_categories = Category::data_tree($categories, 0);
        $category = Category::find($id);
        if ($category->depth == 0) {
            $categories = Category::where('parent_id', $category->id)->get();
            // dd($categories);
            $category_condition = [];
            foreach ($categories as $key => $category) {
                $category_condition[] = $category->id;
            }
            // dd($category_condition);
            $products = Product::whereIn('category_id', $category_condition)->paginate(8);
            // dd($products);
        }else{
            $products = Product::where('category_id', $id)->paginate(8);
        }
        // dd($products);
        return view('frontend.home.productsCategory',[
            // 'list_categories' => $list_categories,
            'products' => $products
        ]);
    }
    //

    public function login(){
        return view('frontend.home.login');
    }

    // public function storeAjax(Request $request)
    // {
    //     $user = new User();
    //     $user->name = $request->get('name');
    //     $user->address = $request->get('address');
    //     $user->phone = $request->get('phone');
    //     $user->email = $request->get('email');
    //     $user->password = Hash::make($request->get('password'));
    //     $user->role = $request->get('role');
    //     $user->save();
    //     return redirect()->route('frontend.home.index');
    // }
    
    public function wishlist(){

        return view("frontend.home.wishlist");
    }

    public function addWishlist(Request $request, $id){
        // dd($id);
        echo "đang xây dựng";
        // $request->session()->forget('products');
        // dd('done');
        // $product = Product::findOrFail($id);
        // dd($product);
        // if ($request->session()->has("products.$id")) {
        //     return redirect()->route('frontend.home.index');
        // }else{
        //     $request->session()->push("products.$id", $product);
        // }
        // echo "done";
        // $data = $request->session()->all();
        // dd($data);
    }

    // ProfileUser
    public function userProfile(){
        $orders = Order::where('email', Auth::user()->email)->whereIn('status', [Order::STATUS['dathang'], Order::STATUS['danggiaohang'], Order::STATUS['trahang']])->get();
        // dd($orders);
        return view('frontend.home.userProfile',[
            'orders' => $orders
        ]);
    }
    public function editProfile(){
        return view('frontend.home.editUser');
    }
    public function storeUser(Request $request, $id){
        // dd($request->all());
        // $validator = Validator::make($request->all(),
        //     [
        //         'name' => ['required'],
        //         'email' => ['required'],
        //         'password' => ['required'],
        //         'phone' => ['required', 'numeric'],
        //         'address' => ['required'],
        //     ],
        //     [
        //         'required' => ':attribute Không được để trống',
        //         // 'min' => ':attribute Không được nhỏ hơn :min',
        //         'numeric' => ':attribute phải là số'
        //     ],
        //     [
        //         'name' => 'Tên người dùng',
        //         'email' => 'địa chỉ email',
        //         'password' => 'Mật khẩu',
        //         'phone' => 'Số điện thoại',
        //         'address' => 'Địa chỉ',
        //     ]
        // );
        // // dd($request->all());
        // if ($validator->errors()){
        //     return back()
        //     ->withErrors($validator)
        //     ->withInput();
        // }
        // dd($request->all());
        // dd($request->file('image'));
        $user = User::find($id);
        $user->name = $request->get('name');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $nameFile = $image->getClientOriginalName();
            $url = Storage::url($nameFile);
            // dd($url);
            Storage::disk('public')->putFileAs('', $image, $nameFile);
            $user->image = $url;
        }
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');
        // dd($user);
        $user->save();
        return redirect()->route('frontend.home.userProfile');
    }
    public function cancelOrder($id){
        $order = Order::findOrFail($id);
        // dd($order);
        $order->status = Order::STATUS['huyhang'];
        $order->save();
        return redirect()->route('frontend.home.userProfile');
    }

    //Filter
    public function filter(){
        return view('frontend.home.filter');
    }
}