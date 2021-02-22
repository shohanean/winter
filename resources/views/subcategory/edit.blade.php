@extends('layouts.starlight')

@section('page_title')
    Sub Category
@endsection
@section('subcategory')
    active
@endsection

@section('content')
@include('layouts.nav')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ url('subcategory') }}">Sub Category</a>
        <span class="breadcrumb-item active">{{ $subcategory_info->sub_category_name }}</span>
      </nav>

      <div class="sl-pagebody">
        <div class="container">
    <div class="row">
        <div class="col-md-4 m-auto">
            <div class="card">
                <div class="card-header">
                    Edit Sub Category
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error_status'))
                        <div class="alert alert-danger">
                            {{ session('error_status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ url('subcategory/update') }}/{{ $subcategory_info->id }}">
                        @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="hidden" value="{{ $subcategory_info->id }}" name="sub_category_id">
                            <select name="category_id" class="form-control">
                                <option value="">-Select One-</option>
                                @foreach ($categories as $category)
                                    <option {{ ($subcategory_info->category_id == $category->id) ? "selected":"" }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Sub Category Name</label>
                            <input type="text" class="form-control" name="sub_category_name" value="{{ $subcategory_info->sub_category_name }}">
                            @error('sub_category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-info">Edit Sub Category</button>
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
