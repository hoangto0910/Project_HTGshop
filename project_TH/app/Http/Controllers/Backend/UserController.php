<?php

namespace App\Http\Controllers\Backend;
use App\Models\User_info;
use App\User;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Cache;



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

    

    public function test_session(Request $request){
        // session(['name' => 'hoang']);
        session([
            'name' => 'Hoang',
            'age' => '22'
        ]);
        // $request->session()->put('address', 'linhnam');
        $request->session()->push('dev.name', 'hoang');
        $request->session()->push('dev.age', '22');
        echo('done');
    }

    public function getSession(Request $request){
        // $value = $request->session()->get('dev');
        $value =  $request->session()->all();
        // dd($value);
        // if ($request->session()->has('dev')) {
        //     echo "co";
        // }else{
        //     echo "khong co";
        // }
        // $request->session()->pull('dev');
        $request->session()->forget('age');
        
        echo "done";
        // dd($value);
    }

    public function cookie(){
        // $cookie = cookie('giohang', '1', 1);
        // return response('hello world')->cookie('giohang2', '1', 1);
        Cookie::queue('email', 'hoang@gmail.com', 1);
        return 1;
    }

    public function getCookie(Request $request){
        Cookie::queue('email', 'hoang@gmail.com');
        Cookie::queue('name', 'hoang');
        $email = $request->cookie('email');
        $name = $request->cookie('name');
        echo "email : " . $email . "<br>";
        echo "name : " . $name . "<br>";
    }

    public function storeAjax(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'min:4'],
            'email' => ['required'],
            'password' => ['required'],
            'phone' => ['required', 'numeric'],
            'address' => ['required'],
        ]);
        
        $user = new User();
        $user->name = $request->get('name');
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->role = $request->get('role');
        $user->save();
        return redirect()->route('frontend.home.index');
    }

    public function cache(){
        // Cache::put('name', 'hoang', 10);
        // $cache = Cache::add('age', '22', 20);
        // echo "done"
        // dd(Cache::get('name'));
        //luu  text
        // if (!Cache::has('name')) {
        //     $name_db = 'Hoang';
        //     Cache::put('name', $name_db, 2);
        // }
        // $name = Cache::get('name');
        // echo $name;
        //luu dang array
        // if (!Cache::has('categories')) {
        //     $categories = [
        //         'hoten' => 'hoang',
        //         'age' => 22
        //     ];
        //     Cache::put('categories', $categories, 2);
        // }
        // $categories = Cache::get('categories');
        // dd($categories);

        //Luu 1 object model
        // if (!Cache::has('categories')) {
        //     $categories = Category::all();
        //     Cache::put('categories', $categories, 20);
        // }
        // $categories = Cache::get('categories');
        // dd($categories);

        //dem
        // $cache = Cache::increment('view_count', 20);
        // echo $cache;

        $categories =  Cache::remember('categories', 10, function(){
            return Category::all();
        }); // dam bao categories luon co du lieu
        dd($categories);
        // dd($cache);
    }

    public function addImage(Request $request){
        // dd('submit');
        $image = $request->file('image');
        $nameFile = $image->getClientOriginalName();
        $url = Storage::url($nameFile);
            // dd($url);
        Storage::disk('public')->putFileAs('', $image, $nameFile);
        dd($url);
    }
}
