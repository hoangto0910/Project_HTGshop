@extends('backend.includes.layouts.app')
@section('head-css')
    <style>
        body{
            background-image: url('https://coloredbrain.com/wp-content/uploads/2016/07/login-background.jpg') !important;
            background-size: cover !important;
        }
        .card-color{
            background: white !important;
            border-radius: 5px !important;
        }
        .border{
            border-radius: 5px;
        }
        .mr-top{
            margin-top: 50px;
        }
    </style>
@endsection
@section('content')
<div class="login-box">
    {{-- <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div> --}}
    <!-- /.login-logo -->
    <div class="card card-color">
        <div class="card-body login-card-body card-color">
            <h3><i><p class="login-box-msg">Đăng nhập</p></i></h3>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email" >

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row mr-top">
                    <div class="col-8">
                        <div class="icheck-primary">
                            {{-- <input type="checkbox" id="remember"> --}}
                            <label for="remember">
                                <a href="">Quên mật khẩu</a>
                            </label>
                            <label for=""><a href="{{ route('register') }}" class="text-center">Đăng ký tài khoản mới</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary">Đăng nhập</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            {{-- <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div> --}}
            <!-- /.social-auth-links -->

            {{-- <p class="mb-1">
                <a href="#">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
            </p> --}}
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection

