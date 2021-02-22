@extends('layouts.starlight')
@section('page_title')
    Product
@endsection
@section('product')
    active
@endsection

@section('content')
@include('layouts.nav')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <span class="breadcrumb-item active">Product</span>
    </nav>

    <div class="sl-pagebody">
    <div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Category List
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Product Name</th>
                                <th>Category Name</th>
                                <th>Product Description</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                                <th>Product Photo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <th>{{ $loop->index + 1 }}</th>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ App\Models\Category::find($product->category_id)->category_name }}</td>
                                <td>{{ $product->product_description }}</td>
                                <td>{{ $product->product_price }}</td>
                                <td>{{ $product->product_quantity }}</td>
                                <td>
                                    <img src="{{ asset('uploads/product_photos') }}/{{ $product->product_photo }}" alt="" class="w-100">
                                </td>
                                {{-- <td>{{ $category->category_name }}</td>
                                <td>
                                    {{ App\Models\User::find($category->added_by)->name }}
                                    <br>
                                    {{ App\Models\User::find($category->added_by)->email }}
                                </td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                    <a href="{{ url('category/delete') }}/{{ $category->id }}" class="btn btn-danger btn-sm">Delete</a>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Add Product
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ url('product/insert') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <select class="form-control" name="category_id">
                                <option value="">-Select One-</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sub Category Name</label>
                            <select class="form-control" name="sub_category_id">
                                <option value="">-Select One-</option>
                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ App\Models\Category::find($subcategory->category_id)->category_name }} - {{ $subcategory->sub_category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" class="form-control" id="" name="product_name">
                        </div>
                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea name="product_description" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="text" class="form-control" id="" name="product_price">
                        </div>
                        <div class="form-group">
                            <label>Product Quantity</label>
                            <input type="text" class="form-control" id="" name="product_quantity">
                        </div>
                        <div class="form-group">
                            <label>Product Photo</label>
                            <input type="file" class="form-control" id="" name="product_photo">
                        </div>
                        <div class="form-group">
                            <label>Product Thumbnail Photos</label>
                            <input type="file" class="form-control" id="" name="product_thumbnail_photos[]" multiple>
                        </div>
                        <button type="submit" class="btn btn-success">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->
@endsection
