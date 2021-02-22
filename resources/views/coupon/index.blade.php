@extends('layouts.starlight')
@section('page_title')
    Coupon
@endsection
@section('coupon')
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
                    Coupon List
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Coupon Name</th>
                                <th>Coupon Discount Amount</th>
                                <th>Coupon Validity Till</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $coupon)
                            <tr>
                                <th>{{ $loop->index + 1 }}</th>
                                <td>{{ $coupon->coupon_name }}</td>
                                <td>{{ $coupon->coupon_discount_amount }}</td>
                                <td>{{ \Carbon\Carbon::parse($coupon->coupon_validity_till)->diffForHumans() }}</td>
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
                    Add Coupon
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('roadofcouponinsert') }}">
                        @csrf
                        <div class="form-group">
                            <label>Coupon Name</label>
                            <input type="text" class="form-control" id="coupon_name" name="coupon_name">
                            @error('coupon_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Coupon Discount Amount (%)</label>
                            <input type="text" class="form-control" id="coupon_discount_amount" name="coupon_discount_amount">
                            @error('coupon_discount_amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Coupon Validity Till</label>
                            <input type="date" class="form-control" id="coupon_validity_till" name="coupon_validity_till">
                            @error('coupon_validity_till')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Add Coupon</button>
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
