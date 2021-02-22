@extends('layouts.starlight')
@section('page_title')
    Category
@endsection
@section('category')
    active
@endsection

@section('content')
@include('layouts.nav')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <span class="breadcrumb-item active">Category</span>
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
                                <th>Category Name</th>
                                <th>Added By</th>
                                <th>Account Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <th>{{ $loop->index + 1 }}</th>
                                <td>{{ $category->category_name }}</td>
                                <td>
                                    {{ App\Models\User::find($category->added_by)->name }}
                                    <br>
                                    {{ App\Models\User::find($category->added_by)->email }}
                                </td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                    <a href="{{ url('category/delete') }}/{{ $category->id }}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
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
                    Add Category
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ url('category/insert') }}">
                        @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name">
                            @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Add Category</button>
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
