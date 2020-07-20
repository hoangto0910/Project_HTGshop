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
<div class="register-box">
	<div class="register-logo">
		{{-- <a href="../../index2.html"><b>Admin</b>LTE</a> --}}
	</div>

	<div class="card card-color">
		<div class="card-body register-card-body card-color">
			<h3><i><p class="login-box-msg">Đăng Ký tài khoản</p></i></h3>

			<form action="{{ route('register') }}" method="post">
				@csrf
				<input type="hidden" value="4" name='role'>
				<div class="input-group mb-3">
					<input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Full name">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
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
					<input type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" name="password" placeholder="Password">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
					@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<div class="input-group mb-3">
					<input type="password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Retype password">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="text" class="form-control" name="phone" placeholder="Phone number">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="text" class="form-control" name="address" placeholder="Address">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="row mr-top">
					<div class="col-8">
						<div class="icheck-primary">
							{{-- <input type="checkbox" id="agreeTerms" name="terms" value="agree"> --}}
							<label for="agreeTerms">
								Đã có tài khoản <a href="{{ route('login') }}">Đăng nhập</a>
							</label>
						</div>
					</div>
					<!-- /.col -->
					<div class="col-4">
						<button type="submit" class="btn btn-primary">Đăng ký ngay</button>
					</div>
					<!-- /.col -->
				</div>
			</form>

			{{-- <a href="" class="text-center">I already have a membership</a> --}}
		</div>
		<!-- /.form-box -->
	</div><!-- /.card -->
</div>
@endsection