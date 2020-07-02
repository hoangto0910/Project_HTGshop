<?php

namespace App\Http\Controllers\Backend;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('admins')) {
            $categories = Category::all();
            $categories = Category::paginate(5);
            return view("backend.categories.index", [
                "categories" => $categories
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
            return view('backend.categories.create');
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
    public function store(StoreCategoryRequest $request)
    {
        if (Gate::allows('admins')) {
            $category = new Category();
            $category->name = $request->name;
        // $category->slug
            $category->parent_id = $request->parent_id;
            $category->depth = $request->depth;
        $category->save(); // luu tat ca thuoc tinh vao key cot trong bang
        return redirect()->route('backend.category.index');        }else{
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
        $category = Category::find($id); // quan he 1 n
        foreach ($category->products as $product) { // khoa chinh la id.c phu la category_id cua products
            echo $product->content . "<br>";
        }
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
            $category = Category::find($id);
            return view('backend.categories.edit',[
                'category' => $category
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
    public function update(StoreCategoryRequest $request, $id)
    {
        if (Gate::allows('admins')) {
            $category = Category::find($id);
            $category->name = $request->name;
            $category->parent_id = $request->parent_id;
            $category->depth = $request->depth;
            $category->save();
            return redirect()->route('backend.category.index');
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
            $category = Category::find($id);
            $category->delete();
            return redirect()->route('backend.category.index');
        }else{
            return abort('403');
        }
    }

    public function showProducts($category_id){
        $category = Category::find($category_id);
        $products = $category->products;
        return view("backend.categories.showProducts",[
            'products' => $products
        ]);
    }
}
