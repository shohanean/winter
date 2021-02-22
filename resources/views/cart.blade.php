@extends('layouts.tohoney')
@section('content')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shopping Cart</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Shopping Cart</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- cart-area start -->
<div class="cart-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
            @if(session('coupon_error'))
                <div class="alert alert-danger">
                {{ session('coupon_error') }}
                </div>
            @endif
                <table class="table-responsive cart-wrap">
                    <thead>
                        <tr>
                            <th class="images">Image</th>
                            <th class="product">Product</th>
                            <th class="ptice">Price</th>
                            <th class="quantity">Quantity</th>
                            <th class="total">Total</th>
                            <th class="remove">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ url('update/cart') }}" method="POST">
                            @csrf
                        @php
                            $total = 0;
                            $checkout_button_status = true;
                        @endphp
                        @foreach ($cart_items as $cart_item)
                        <tr>
                            <td class="images"><img src="{{ asset('uploads/product_photos') }}/{{ App\Models\Product::find($cart_item->product_id)->product_photo }}" alt=""></td>
                            <td class="product">
                                <a target="_blank" href="{{ url('product/details') }}/{{ $cart_item->product_id }}">
                                    {{ App\Models\Product::find($cart_item->product_id)->product_name }}
                                    @if ($cart_item->cart_amount > App\Models\Product::find($cart_item->product_id)->product_quantity)
                                        <div class="badge badge-danger">Stock Out</div>
                                        <div class="badge badge-success">Available: {{ App\Models\Product::find($cart_item->product_id)->product_quantity }}</div>
                                        @php
                                            $checkout_button_status = false;
                                        @endphp
                                    @endif
                                </a>
                            </td>
                            <td class="ptice">{{ App\Models\Product::find($cart_item->product_id)->product_price }}</td>
                            <td class="quantity cart-plus-minus">
                                <input class="shohan" name="cart_amount[{{ $cart_item->id }}]" type="text" value="{{ $cart_item->cart_amount }}"/>
                            </td>
                            <td class="total">
                                {{ App\Models\Product::find($cart_item->product_id)->product_price * $cart_item->cart_amount }}
                            </td>
                            <td class="remove">
                                <a href="{{ url('cart/delete') }}/{{ $cart_item->id }}">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        @php
                            $total = $total + (App\Models\Product::find($cart_item->product_id)->product_price * $cart_item->cart_amount);
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                <div class="row mt-60">
                    <div class="col-xl-4 col-lg-5 col-md-6 ">
                        <div class="cartcupon-wrap">
                            <ul class="d-flex">
                                <li>
                                    <button id="update_cart_btn">Update Cart</button>
                                </li>
                                </form>
                                <li><a href="{{ url('shop') }}">Continue Shopping</a></li>
                            </ul>
                            <h3>Coupon</h3>
                            <p>Enter Your Coupon Code if You Have One</p>
                            <div class="cupon-wrap">
                                <input id="apply_coupon_field" type="text" placeholder="Coupon Code" value="{{ $coupon_name }}">
                                <button id="apply_coupon_btn">Apply Coupon</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                        <div class="cart-total text-right">
                            <h3>Cart Totals</h3>
                            <ul>
                                <li><span class="pull-left">Total </span>{{ $total }}</li>
                                <li><span class="pull-left">Discount ({{ $discount }}%)</span>-{{ round((($discount/100)*$total)) }}</li>
                                <li><span class="pull-left"> Subtotal </span>{{ round($total - (($discount/100)*$total)) }}</li>
                                @php
                                    session([
                                        'total_from_cart' => $total,
                                        'discount_from_cart' => round((($discount/100)*$total)),
                                    ]);
                                @endphp
                            </ul>
                            @if ($checkout_button_status)
                                <a href="{{ url('checkout') }}">Proceed to Checkout</a>
                                @else
                                <a href="">Check Stock Out Product</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- cart-area end -->
@endsection

@section('footer_scripts')
<script>
    $(document).ready(function (){
        $('#apply_coupon_btn').click(function(){
            var current_link = "{{ url('cart') }}";
            var link_to_go = current_link + "/" +$('#apply_coupon_field').val();
            window.location.href = link_to_go;
        });
        $('.shohan').change(function() { 
            $('#update_cart_btn').addClass('btn btn-success');
            $('#update_cart_btn').html('update now');
        }); 
    });
</script>
@endsection