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
        <span class="breadcrumb-item active">Sub Category</span>
      </nav>

      <div class="sl-pagebody">
        <div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Sub Category List
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('subcategory/mark/delete') }}">
                    @csrf
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mark</th>
                                <th>Serial No</th>
                                <th>Sub Category Name</th>
                                <th>Category Name</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subcategories as $key => $subcategory)
                            <tr>
                                <th>
                                    <input type="checkbox" value="{{ $subcategory->id }}" name="mark_delete_id[]">
                                </th>
                                <th>{{ $subcategories->firstItem() + $key }}</th>
                                <td>{{ $subcategory->sub_category_name }}</td>
                                <td>
                                    {{ App\Models\Category::find($subcategory->category_id)->category_name }}
                                </td>
                                <td>{{ $subcategory->created_at }}</td>
                                <td>
                                    <a href="{{ url('subcategory/delete') }}/{{ $subcategory->id }}" class="btn btn-danger btn-sm">Delete</a>
                                    <a href="{{ url('subcategory/edit') }}/{{ $subcategory->id }}" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                            </tr>
                            @empty
                            <tr class="text-center text-danger">
                                <td colspan="50">No Data To Show</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <button value="mark_delete" name="mark_delete" type="submit" class="btn btn-sm btn-danger">Mark Delete</button>
                    <button value="kaj_nai" name="kaj_nai" type="submit" class="btn btn-sm btn-info">Kaj Nai</button>
                    <a href="{{ url('subcategory/all/delete') }}" class="btn btn-sm btn-warning">All Delete</a>
                    </form>
                    {{-- {{ $subcategories->links() }} --}}
                    {{ $subcategories->appends(['deleted_subcategories' => $deleted_subcategories->currentPage()])-> links() }}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Sub Category Restore List
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Sub Category Name</th>
                                <th>Category Name</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deleted_subcategories as $key => $deleted_subcategory)
                            <tr>
                                <th>{{ $loop->index + 1 }}</th>
                                <td>{{ $deleted_subcategory->sub_category_name }}</td>
                                <td>
                                    {{ App\Models\Category::find($deleted_subcategory->category_id)->category_name }}
                                </td>
                                <td>{{ $deleted_subcategory->created_at }}</td>
                                <td>
                                    <a href="{{ url('subcategory/restore') }}/{{ $deleted_subcategory->id }}" class="btn btn-success btn-sm">Restore</a>
                                    <a href="{{ url('subcategory/permanent/delete') }}/{{ $deleted_subcategory->id }}" class="btn btn-danger btn-sm">P.D.</a>
                                </td>
                            </tr>
                            @empty
                            <tr class="text-center text-danger">
                                <td colspan="50">No Data To Show</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $deleted_subcategories->links() }} --}}
                    {{ $deleted_subcategories->appends(['subcategories' => $subcategories->currentPage()])-> links() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Add Sub Category
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
                    <form method="POST" action="{{ url('subcategory/insert') }}">
                        @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <select name="category_id" class="form-control">
                                <option value="">-Select One-</option>
                                @foreach ($categories as $category)
                                    <option {{ (old('category_id') == $category->id) ? "selected":"" }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Sub Category Name</label>
                            <input type="text" class="form-control" name="sub_category_name" value="{{ old('sub_category_name') }}">
                            @error('sub_category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Add Sub Category</button>
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
