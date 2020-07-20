<?php

namespace App\Http\Controllers\Backend;
use App\Models\Order;
use App\Models\Product;
use App\Models\Order_product;
use App\Models\Financial_report;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('updated_at', 'DESC')->get();
        // dd($orders);
        return view('backend.orders.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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

    public function showProducts($id){
        $order = Order::find($id);
        $products = $order->products;
        return view('backend.orders.showProducts',[
            'products' => $products
        ]);
    }

    public function showDetail($id){
        // dd($id);
        // $order = Order::findOrFail($id);
        // dd($order);
        // $order_products = $order->products;
        // dd($order_products);

        $order_products = Order_product::where('order_id', $id)->get();
        // dd($order_products);
        return view('backend.orders.order_products', [
            'order_products' => $order_products
        ]);
    }

    //xoa san pham trong order
    public function destroyOrder_product($id, $order_id){
        $order_product = Order_product::findorFail($id);
        // dd($id);
        // dd($order_id);
        $order_product->delete();
        return redirect()->route('backend.order.showDetail', $order_id);
    }

    // Giao hang thành công + thêm doanh thu
    public function success($id){
        // dd($id);
        $order = Order::find($id);
        $financial_report = Financial_report::findOrFail(1);
        $financial_report->total = $financial_report->total + $order->total_price;
        // dd($financial_report->total);
        // Lưu doanh thu
        $financial_report->save();
        // Giao hàng xong xóa đơn
        $order->delete();
        // Đồng thời xóa chi tiết các sp trong đơn
        $order_products = Order_product::where('order_id', $id)->get();
        foreach ($order_products as $product) {
            $product->delete();
        }
        return redirect()->route('backend.order.index');
    }

    //chinh sửa order
    public function editOrder($id){
        // dd($id);
        $order = Order::find($id);
        // dd($order);
        return view('backend.orders.edit',[
            'order' => $order
        ]);
    }

    public function updateOrder(Request $request, $id){
        // dd($id);
        // dd($request);
        $order = Order::find($id);
        $order->name = $request->get('name');
        $order->status = $request->get('status');
        // dd($order);
        $order->save();
        return redirect()->route('backend.order.index');
    }

    // viewdetail
    public function orderProcess(){
        $ordersProcess = Order::whereIn('status', [0,1,2,4])->get();
        return view('backend.orders.order_process',[
            'ordersProcess' => $ordersProcess
        ]);
    }
    public function orderSuccess(){
        $ordersSuccess = Order::where('status', 3)->get(); // nen sua thanh hang so
        return view('backend.orders.ordersSuccess',[
            'ordersSuccess' => $ordersSuccess
        ]);
    }
    public function orderToday(){
        $ordersToday = Order::whereDate('updated_at', Carbon::now())->where('status', Order::STATUS['dagiaohang'])->get();
        // dd($ordersToday);
        return view('backend.orders.orderToday', [
            'ordersToday' => $ordersToday
        ]);
    }
}
