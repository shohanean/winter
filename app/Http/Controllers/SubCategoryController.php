<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;

class SubCategoryController extends Controller
{
    function index()
    {
        return view('subcategory.index', [
            'categories' => Category::latest()->get(),
            'subcategories' => Subcategory::paginate(10, ['*'], 'subcategories'),
            'deleted_subcategories' => Subcategory::onlyTrashed()->paginate(10, ['*'], 'deleted_subcategories')
        ]);
    }
    function insert(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'sub_category_name' => 'required|string|max:255'
        ]);
        if(Subcategory::withTrashed()->where('category_id', $request->category_id)->where('sub_category_name', $request->sub_category_name)->exists()){
            return back()->with('error_status', 'Sub Category Already Exists!');
        }
        else{
            Subcategory::insert([
                'category_id' => $request->category_id,
                'sub_category_name' => $request->sub_category_name,
                'created_at' => Carbon::now()
            ]);
            return back()->with('status', 'Sub Category Added Successfully!');
        }
    }
    function delete($subcategory_id){
        Subcategory::find($subcategory_id)->delete();
        return back();
    }
    function restore($subcategory_id){
        Subcategory::onlyTrashed()->find($subcategory_id)->restore();
        return back();
    }
    function permanentdelete($subcategory_id){
        Subcategory::onlyTrashed()->find($subcategory_id)->forceDelete();
        return back();
    }
    function markdelete(Request $request){
        if($request->mark_delete){
            if ($request->mark_delete_id) {
                foreach ($request->mark_delete_id as $single_mark_delete_id) {
                    Subcategory::find($single_mark_delete_id)->delete();
                }
            }
            return back();
        }
        else{
            echo "You click kaj nai button!";
        }
    }
    function alldelete(){
        Subcategory::whereNotNull('id')->delete();
        return back();
    }
    function edit($subcategory_id){
        return view('subcategory.edit', [
            'categories' => Category::all(),
            'subcategory_info' => Subcategory::find($subcategory_id)
        ]);
    }
    function update(Request $request){
        Subcategory::find($request->sub_category_id)->update([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name
        ]);
        return back();
    }
}
