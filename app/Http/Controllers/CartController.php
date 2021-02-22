<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Country;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Order_billing_detail;
use App\Models\Order_detail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Cookie;


class CartController extends Controller
{
    function cart($coupon_name=""){
        if($coupon_name == ""){
            $discount = 0;
        }
        else{
            if(Coupon::where('coupon_name', $coupon_name)->exists()){
                if(Carbon::now()->format('Y-m-d') > Coupon::where('coupon_name', $coupon_name)->first()->coupon_validity_till){                    
                    return back()->with('coupon_error', 'This coupon date has expired!');
                }
                else{
                    $discount = Coupon::where('coupon_name', $coupon_name)->first()->coupon_discount_amount;
                }
            }
            else{
                return back()->with('coupon_error', 'There is no coupon that you entered!');
            }
        }
        return view('cart', [
            'discount' => $discount,
            'coupon_name' => $coupon_name,
            'cart_items' => Cart::where('generated_cart_id', Cookie::get('generated_cart_id'))->get()
        ]);
    }
    function addtocart(Request $request){        
        if(Cookie::get('generated_cart_id')){
            $randomly_generated_cart_id = Cookie::get('generated_cart_id');
        }
        else{
            $randomly_generated_cart_id = Str::random(5).time();
            Cookie::queue(Cookie::make('generated_cart_id', $randomly_generated_cart_id, 7200)); //5 days        
        }

        if(Cart::where('generated_cart_id', $randomly_generated_cart_id)->where('product_id', $request->product_id)->exists()){
            Cart::where('generated_cart_id', $randomly_generated_cart_id)->where('product_id', $request->product_id)->increment('cart_amount', $request->cart_amount);
        }
        else{
            Cart::insert([
                'generated_cart_id' => $randomly_generated_cart_id,
                'product_id' => $request->product_id,
                'cart_amount' => $request->cart_amount,
                'created_at' => Carbon::now()
            ]);
        }
        return back()->with('cart_success', 'Your product added to cart successfully!');
    }
    function cartdelete($cart_id){
        Cart::find($cart_id)->delete();
        return back();
    }

    function updatecart(Request $request){        
        foreach ($request->cart_amount as $cart_id => $cart_amount) {
            Cart::find($cart_id)->update([
                'cart_amount' => $cart_amount
            ]);
        }
        return back();
    }
    function checkout(){
        $countries = Country::select('id', 'name')->get();
        return view('checkout', compact('countries'));
    }
    function getCityList(Request $request){
        $cities = City::where('country_id', $request->country_id)->get();
        $str_to_send = "<option value=''>-Select City-</option>";
        foreach($cities as $city){
            $str_to_send .= "<option value='".$city->id."'>".$city->name."</option>";
        }
        echo $str_to_send;
    }
    function checkoutpost(Request $request){
        if($request->payment_status == 1 || $request->payment_status == 2){
            $order_id = Order::insertGetId([
                'total' => session('total_from_cart'),
                'discount' => session('discount_from_cart'),
                'subtotal' => session('total_from_cart') - session('discount_from_cart'),
                'payment_status' => $request->payment_status,
                'created_at' => Carbon::now()
            ]);
            Order_billing_detail::insert([
                'order_id' => $order_id,
                'name' => $request->name,
                'email_address' => $request->email_address,
                'phone_number' => $request->phone_number,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'house_flat' => $request->house_flat,
                'postcode' => $request->postcode,
                'notes' => $request->notes,
                'created_at' => Carbon::now()
            ]);
            $cart_items = Cart::where('generated_cart_id', Cookie::get('generated_cart_id'))->get();
            foreach ($cart_items as $cart_item){
                Order_detail::insert([
                    'order_id' => $order_id,
                    'product_name' => Product::find($cart_item->product_id)->product_name,
                    'product_price' => Product::find($cart_item->product_id)->product_price,
                    'product_quantity' => $cart_item->cart_amount,
                    'created_at' => Carbon::now()
                ]);
            }
        }
        else{
            echo "This payment type not available";
        }
    }
}
