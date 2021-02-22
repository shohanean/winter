<li class="col-xl-3 col-lg-4 col-sm-6 col-12">
    <div class="product-wrap">
        <div class="product-img">
            <img src="{{ asset('uploads/product_photos') }}/{{ $product->product_photo }}" alt="{{ asset('uploads/product_photos') }}/{{ $product->product_photo }}">
            <div class="product-icon flex-style">
                <ul>
                    <li>
                        <a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a>
                    </li>
                    <li><a href="{{ url('product/details') }}/{{ $product->id }}"><i class="fa fa-shopping-bag"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="product-content">
            <h3><a href="{{ url('product/details') }}/{{ $product->id }}">{{ $product->product_name }}</a></h3>
            <p class="pull-left">{{ $product->product_price }}

            </p>
            <ul class="pull-right d-flex">
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star-half-o"></i></li>
            </ul>
        </div>
    </div>
</li>
