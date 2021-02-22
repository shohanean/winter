@extends('layouts.tohoney')
@section('content')
<!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shop Page</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shop</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- product-area start -->
    <div class="container">
        <div class="row pt-4">
            <div class="col-12">
                <div class="section-title">
                    <h2>Category Wise Shop Page: {{ $category_name }}</h2>
                    <img src="assets/images/section-title.png" alt="">
                </div>
            </div>
        </div>
        <ul class="row">
            @foreach ($all_products as $productssss)
                @include('part/product_list', ['product' => $productssss])
            @endforeach
        </ul>
    </div>
    <!-- product-area end -->
@endsection
