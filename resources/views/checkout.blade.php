@extends('layouts.tohoney')
@section('content')
@auth
@if(Auth::user()->role == 1)
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- checkout-area start -->
    <div class="checkout-area ptb-100">
        <div class="container">
        <form action="{{ url('checkout/post') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-form form-style">
                        <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <p>Name *</p>
                                    <input type="text" name="name" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Email Address *</p>
                                    <input type="email" name="email_address" value="{{ Auth::user()->email }}">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Phone No. *</p>
                                    <input type="text" name="phone_number">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Country *</p>
                                    <select name="country_id" id="country_select">
                                        <option value="">-Select Country-</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>City *</p>
                                    <select name="city_id" id="city_select">
                                        
                                    </select>
                                </div>
                                <div class="col-12">
                                    <p>Your Address *</p>
                                    <input type="text" name="address">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>House/Flat</p>
                                    <input type="text" name="house_flat">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Postcode/ZIP</p>
                                    <input type="text" name="postcode">
                                </div>
                                <div class="col-12">
                                    <p>Order Notes </p>
                                    <textarea name="notes" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-area">
                        <h3>Your Order</h3>
                        <ul class="total-cost">
                            <li>Total <span class="pull-right"><strong>{{ session('total_from_cart') }}</strong></span></li>
                            <li>Discount <span class="pull-right">{{ session('discount_from_cart') }}</span></li>
                            <li>Subtotal<span class="pull-right">{{ session('total_from_cart') - session('discount_from_cart') }}</span></li>
                        </ul>
                        <ul class="payment-method">
                            <li>
                                <input id="cod" type="radio" name="payment_status" value="1">
                                <label for="cod">Cash on Delivery</label>
                            </li>
                            <li>
                                <input id="online" type="radio" name="payment_status" value="2">
                                <label for="online">Online</label>
                            </li>
                        </ul>
                        <button>Place Order</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    <!-- checkout-area end -->
@else
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning mt-4">
                You are not customer
                <br>
                <a href="{{ route('login') }}">
                Go Home
                </a>
            </div>
        </div>
    </div>
</div>
@endif
@else
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning mt-4">
                Please Login to view this page
                <br>
                <a href="{{ route('login') }}">
                Click Here
                </a>
            </div>
        </div>
    </div>
</div>
@endauth
@endsection

@section('footer_scripts')
<script>
$(document).ready(function() {
    $('#country_select').select2();
    $('#country_select').change(function(){
        var country_id = $('#country_select').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type : 'POST',
            url : '/getCityList',
            data : {country_id:country_id},
            success : function(data){                
                $('#city_select').html(data);
                $('#city_select').select2();
            }
        });
    });
});
</script>
@endsection