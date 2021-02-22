@extends('layouts.starlight')

@section('page_title')
    Profile
@endsection

@section('content')
@include('layouts.nav')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <span class="breadcrumb-item active">Profile</span>
    </nav>

    <div class="sl-pagebody">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Change Name
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('profile/name/change') }}">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                            @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-info">Change Name</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Change Password
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ url('profile/password/change') }}">
                        @csrf
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" class="form-control" name="old_password">
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation">
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-warning">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Change Profile Photo
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ url('profile/photo/change') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group text-center">
                            <label>Current Profile Photo</label>
                            <br>
                            <img class="w-25 border" src="{{ asset('uploads/profile_photos') }}/{{ Auth::user()->profile_photo }}" alt="">
                        </div>
                        <div class="form-group">
                            <label>New Profile Photo</label>
                            <input type="file" class="form-control-file" name="new_profile_photo">
                            @error('new_profile_photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-secondary">Change Profile Photo</button>
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
