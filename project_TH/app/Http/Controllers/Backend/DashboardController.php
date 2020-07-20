<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Financial_report;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\User; // logic phai use Trong view nen dung namespace
use App\Models\Order;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == null || Auth::user()->role == User::ROLE['user']) {
            return redirect()->route('home.index');
        }
        elseif(Auth::user()->role == User::ROLE['admin'] || Auth::user()->role == User::ROLE['content'] || Auth::user()->role == User::ROLE['sale_person']){
            $products = Product::all();
            $users = User::all();
            $orders_process = Order::whereIn('status', [0,1,2,4])->get();
            // dd($orders_process);
            $orders = Order::where('status', 3)->get();
            $financial_report = Financial_report::find(1);
            // Lấy tất cả order trong ngày với status đã giao hàng xong 
            $orders_today = Order::whereDate('updated_at', Carbon::now())->where('status', Order::STATUS['dagiaohang'])->get();
            // Cộng tổng tiền các order trong ngày đã giao hàng xong
            $budget = 0;
            foreach ($orders_today as $order) {
                $budget += $order->total_price;
            }
            // dd($orders_today);
            // dd(count($products));
            return view('backend.products.dashboard', [
                'products' => $products,
                'users' => $users,
                'orders_process' => $orders_process,
                'orders' => $orders,
                'financial_report' => $financial_report,
                'orders_today' => $orders_today,
                'budget' => $budget
            ]);
        }
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

    public function financialReport(){

    }
}
