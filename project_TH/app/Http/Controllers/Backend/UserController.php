<?php

namespace App\Http\Controllers\Backend;
use App\Models\User_info;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

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

        // return Storage::disk('local')->download('text1.txt');
        // return Storage::disk('public')->download('text1.txt');
        if (Gate::allows('admins')) {
            $users = User::all();
            $users = User::paginate(5);
            return view('backend.users.index',[
                'users' => $users
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
            return view('backend.users.create');
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
    {
        if (Gate::allows('admins')) {
            $user = new User();
            $user->name = $request->get('name');
            $user->address = $request->get('address');
            $user->phone = $request->get('phone');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->role = $request->get('role');
            $user->save();
            return redirect()->route('backend.user.index');
        }else{
            return abort('403');
        }
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
        if (Gate::allows('admins')) {
            $user = User::find($id);
            return view('backend.users.edit', [
                'user' => $user
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
        if (Gate::allows('admins')) {
            $user = User::find($id);
            $user->name = $request->get('name');
            $user->address = $request->get('address');
            $user->phone = $request->get('phone');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->role = $request->get('role');
            $user->save();
            return redirect()->route('backend.user.index');
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
            $user = User::find($id);
            $user->delete();
            return redirect()->route('backend.user.index');
        }else{
            return abort('403');
        }
    }

    public function showProducts($user_id){
        $user = User::find($user_id);
        $products = $user->products; // lay ra tat ca sp theo user($id);
        return view('backend.users.showProducts', [
            'products' => $products
        ]);
    }
}
