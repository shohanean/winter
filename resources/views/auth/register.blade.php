@extends('layouts.starlight')

@section('content')
<div class="d-flex align-items-center justify-content-center bg-sl-primary ht-md-100v">

      <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Register <span class="tx-info tx-normal">Panel</span></div>
        <div class="tx-center mg-b-60">Professional Admin Template Design</div>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter your name" name="name">
            @error('name')
                <br>
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
            </div><!-- form-group -->
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Enter your emaill address" name="email">
                @error('email')
                <br>
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div><!-- form-group -->
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Enter your password" name="password">
                @error('password')
                <br>
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div><!-- form-group -->
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Enter your confirm password" name="password_confirmation">
            </div><!-- form-group -->
            <div class="form-group tx-12">By clicking the Sign Up button below, you agreed to our privacy policy and terms of use of our website.</div>
            <button type="submit" class="btn btn-info btn-block">Register</button>
        </form>

        <div class="mg-t-40 tx-center">Already have an account? <a href="{{ url('login') }}" class="tx-info">Sign In</a></div>
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@section('footer_scripts')
<script>
    $(function(){
    'use strict';

    $('.select2').select2({
        minimumResultsForSearch: Infinity
    });
    });
</script>
@endsection
