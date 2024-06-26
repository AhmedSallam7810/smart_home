@extends('admin.layouts.auth')
@section('content')

<div class="card-header text-center">
    <a href="../../index2.html" class="h1"><b>con</b>tech</a>
    </div>
    <div class="card-body">
    <p class="login-box-msg">Sign in to enter dashboard</p>
    <form action="{{route('login')}}" method="post" class="mb-5">
    @csrf
    <div class="input-group mb-3">
    <input type="email" name='email' class="form-control" placeholder="Email">
    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="input-group-append">
    <div class="input-group-text">
    <span class="fas fa-envelope"></span>
    </div>
    </div>
    </div>
    <div class="input-group mb-3">
    <input type="password" name='password' class="form-control" placeholder="Password">
    <div class="input-group-append">
    <div class="input-group-text">
    <span class="fas fa-lock"></span>
    </div>
    </div>
    </div>
    <div class="row ">


    <div class="col-12 mt-3">
    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
    </div>

    </div>
    </form>
    {{-- <div class="social-auth-links text-center mt-2 mb-3">
    <a href="#" class="btn btn-block btn-primary">
    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
    </a>
    <a href="#" class="btn btn-block btn-danger">
    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
    </a>
    </div>

    <p class="mb-1">
    <a href="forgot-password.html">I forgot my password</a>
    </p>
    <p class="mb-0">
    <a href="register.html" class="text-center">Register a new membership</a>
    </p> --}}
    </div>

@endsection
