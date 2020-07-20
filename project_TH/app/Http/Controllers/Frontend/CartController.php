<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_product;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Cart::content();
        // dd(Cart::total(0));
        // dd($items->price);
        // dd($carts_dropdown);
        return view('frontend.home.cart', [
            'items' => $items
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
        Cart::remove($id);
        return redirect()->route('frontend.cart.index');
    }

    public function add($id){
        $product = Product::find($id);
        $category = Category::find($product->category_id);
        // dd($category);
        Cart::add($product->id, $product->name, 1, $product->sale_price, 0, ['path' => $product->image, 'category_name' => $category->name]);
        return redirect()->route('frontend.cart.index');
    }

    // Cộng số lượng sản phẩm
    public function plusQuantity($rowId, $qty){
        // dd($rowId);
        // dd((int)$qty);
        // dd($price);
        $qty = (int)$qty;
        // $price = (int)$price;
        // dd($price);
        Cart::update($rowId, ['qty' => $qty+1]);
        return redirect()->route('frontend.cart.index');
    }

    //Giảm số lượng sản phẩm
    public function decreaseQuantity($rowId, $qty){
        $qty = (int)$qty;
        Cart::update($rowId, $qty-1);
        if ($qty == 0) {
            Cart::remove($rowId);
        }
        return redirect()->route('frontend.cart.index');
    }

    //view THanh toan
    public function viewCheckOut(){
        return view('frontend.home.checkOut');
    }

    // Thanh toan gio hang
    public function checkOut(Request $request){
        //Lưu thông tin order
        // $products = Cart::content();
        // foreach ($products as $key => $value) {
        //     dd(asset($value->options['path']));
        // }
        $validate = $request->validate([
            'name' => ['required', 'min:4'],
            'email' => ['required'],
            'phone' => ['required', 'numeric'],
            'address' => ['required'],
        ]);
        $order = new Order();
        $order->name = $request->get('name');
        $order->email = $request->get('email');
        $order->phone = $request->get('phone');
        $order->address = $request->get('address');
        $order->total_price = Cart::subTotal(0,0,''); // bỏ dấu , -> lưu bigint 
        // dd($order);
        $order->save();
        // dd($order->id);

        //Lưu tất cả sản phẩm trong order vào bảng order-product để quản lý chi tiết
        $products = Cart::content();
        // Foreach mảng collection to Lưu từng cái đối tượng sản phẩm nhỏ một
        foreach ($products as $product) {
            $order_product = new Order_product();
            $order_product->order_id = $order->id;
            $order_product->product_id = $product->id;
            $order_product->quantity = $product->qty;
            $order_product->name = $product->name;
            $order_product->price = $product->qty * $product->price;
            $order_product->image = $product->options['path'];
            $order_product->save();
        }
        Cart::destroy();
        return redirect()->route('frontend.cart.checkOutSuccess');
    }

    public function checkOutSuccess(){
        return view('frontend.home.checkOutSuccess');
    }
}
