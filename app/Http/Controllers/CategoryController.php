<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admincheck');
    }
    function index(){
        $categories = Category::latest()->get();
        return view('category.index', compact('categories'));
    }
    function insert(Request $request){
        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ],[
            'category_name.required' => 'Category koi??',
            'category_name.unique' => 'Duplicate Category Name'
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'added_by' => Auth::id(),
            'created_at' => Carbon::now()
        ]);
        return back()->with('status', 'Category Added Successfully!');
    }
    function delete($category_id){
        Category::find($category_id)->delete();
        Subcategory::where([
            'category_id' => $category_id
        ])->delete();
        return back();
    }
}
