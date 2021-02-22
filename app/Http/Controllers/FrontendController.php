<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index(){
        return view('welcome', [
            'categories' => Category::latest()->get(),
            'products' => Product::latest()->get(),
        ]);
    }
    function product_details($product_id){
        $category_id = Product::find($product_id)->category_id;
        return view('productdetails', [
            'product_info' => Product::find($product_id),
            'related_products' => Product::where('category_id', $category_id)->where('id', '!=', $product_id)->get()
        ]);
    }
    function about(){
        return view('about');
    }
    function contact(){
        return view('contact');
    }
    function portfolio(){
        return view('portfolio');
    }
    function shop(){
        return view('shop', [
            'all_products' => Product::all(),
            'categories' => Category::all()
        ]);
    }
    function shop_category($category_id){
        return view('shopcategory', [
            'category_name' => Category::find($category_id)->category_name,
            'all_products' => Product::where('category_id', $category_id)->latest()->get()
        ]);
    }
}
