<?php

namespace App\Http\Controllers\Backend;
use App\Models\User_info;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('backend.users.index');
        // $user = User::find(1); 
        // $userInfo = $user->user_info; // * 
        // dd($userInfo);
        // Storage::put('public/text1.txt', 'Tohoang');
        // $contents = Storage::get('text1.txt');
        // $check = Storage::disk('local')->exists('text1.txt');
        // Storage::disk('local2')->put('text2.txt', "hoang");
        // dd($check);
        dd(Storage::allFiles('/'));
        return Storage::disk('local')->download('text1.txt');
        // return Storage::disk('public')->download('text1.txt');
        $users = User::all();
        $users = User::paginate(5);
        return view('backend.users.index',[
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
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

    public function showProducts($user_id){
        $user = User::find($user_id);
        $products = $user->products; // lay ra tat ca sp theo user($id);
        return view('backend.users.showProducts', [
            'products' => $products
        ]);
    }
}
