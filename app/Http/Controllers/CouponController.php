<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    function index(){
        return view('coupon.index', [
            'coupons' => Coupon::all()
        ]);
    }
    function insert(Request $request){
        $request->validate([
            'coupon_name' => 'unique:coupons,coupon_name',
            'coupon_discount_amount' => 'integer|max:99|min:1'
        ]);
        Coupon::insert($request->except('_token') + [
            'created_at' => Carbon::now()
        ]);
        return back();
    }
}
