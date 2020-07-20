@extends('frontend.layouts.master')
@section('css-page')
<style>
	.mr-top{
		margin-top: 85px;
	}
	.mr-bottom{
		margin-bottom: 100px;
	}
	.border-img{
		border-radius: 10px;
	}
	.border-rd{
		border-radius: 10%;
	}
	.red-color{
		color: #D10024;
	}
	.img-profile{
		max-width: 20%;
		max-height: 20%;
	}
</style>
@endsection
@section('content')
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<h3 class="breadcrumb-header">Sửa Thông tin</h3>
				<ul class="breadcrumb-tree">
					<li><a href="#">Trang chủ</a></li>
					<li class="active">Sửa Thông tin</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<div class="container mr-top mr-bottom">
	<div class="row">
		<div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
			<div class="col-md-6">
				<h3>Sửa Thông tin user</h3>
				<div class="form-group"><img class="img-profile border-rd" src="{{ asset(Auth::user()->image) }}" alt=""></div>
				<form action="{{ route('frontend.home.storeUser', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="form-group">
						<label for="">Họ tên</label>
						<input class="input" value="{{ Auth::user()->name }}" type="text" name="name"
						>
						@error('name')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input class="input" value="{{ Auth::user()->email }}" type="email" name="email"
						>
						@error('email')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group">
						<label for="">Mật khẩu</label>
						<input class="input" value="" type="password" name="password"
						>
						@error('password')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group">
						<label for="">Số điện thoại</label>
						<input class="input" value="{{ Auth::user()->phone }}" type="phone" name="phone" 
						>
						@error('phone')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group">
						<label for="">Địa chỉ</label>
						<input class="input" value="{{ Auth::user()->address }}" type="text" name="address"
						>
						@error('address')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group">
						<label for="">Ảnh đại diện</label>
						<input class="input" type="file" name="image"
						>
						{{-- @error('address')
							<div class="text-danger">{{ $message }}</div>
						@enderror --}}
					</div>
					<button type="submit" class="btn btn-primary"><i class="fa fa-check-square" aria-hidden="true"></i></button>
				</form>			
			</div>
		</div>
	</div>
</div>
@endsection