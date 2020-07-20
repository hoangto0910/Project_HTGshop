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
		border-radius: 10px;
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
				<h3 class="breadcrumb-header">Thông tin cá nhân</h3>
				<ul class="breadcrumb-tree">
					<li><a href="#">Trang chủ</a></li>
					<li class="active">Thông tin cá nhân</li>
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
				<h3>Thông tin Người dùng</h3>
				<div class="form-group"><img class="img-profile border-rd" src="{{ asset(Auth::user()->image) }}" alt=""></div>
				@if (Auth::user()->name)
				<div class="form-group">
					<label for="">Họ tên</label>
					<input class="input" value="{{ Auth::user()->name }}" type="text" name="name" readonly
					>
				</div>
				@endif
				<div class="form-group">
					<label for="">Email</label>	
					<input class="input" value="{{ Auth::user()->email }}" type="text" name="email" readonly
					>
				</div>
				@if (Auth::user()->phone)
				<div class="form-group">
					<label for="">Số điện thoại</label>
					<input class="input" value="{{ Auth::user()->phone }}" type="email" name="phone" readonly 
					>
				</div>
				@endif
				@if (Auth::user()->address)
				<div class="form-group">
					<label for="">Địa chỉ</label>
					<input class="input" value="{{ Auth::user()->address }}" type="text" name="address" readonly
					>
				</div>
				@endif
				<a href="{{ route('frontend.home.editProfile') }}" class="btn btn-primary"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>			
			</div>
		</div>
	</div>
	@if (count($orders) > 0)
	<div class="row mr-top mr-bottom">
		<div class="col-md-12">
			<div class="table-responsive">
				<h3>Thông tin và trạng thái đơn hàng</h3>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th width="10%" scope="col" class="border-0 bg-light">
								<div class="p-2 px-3 text-uppercase">Mã Order</div>
							</th>
							<th width="30%" scope="col" class="border-0 bg-light text-center">
								<div class="py-2 text-uppercase">Tổng tiền</div>
							</th>
							<th scope="col" class="border-0 bg-light text-center">
								<div class="py-2 text-uppercase">Trạng thái</div>
							</th>
							<th scope="col" class="border-0 bg-light text-center">
								<div class="py-2 text-uppercase">Chức năng</div>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($orders as $order)
						<tr>
							<th scope="row" class="border-0">
								<div class="p-2">
									{{$order->id}}
								</div>
							</th>
							<td class="border-0 align-middle text-center">
								{{number_format($order->total_price)}} VNĐ
							</td>
							<td class="border-0 align-middle text-center">
								<strong>
									@if ($order->status == App\Models\Order::STATUS['huyhang'])
									Hủy hàng
									@elseif ($order->status == App\Models\Order::STATUS['dathang'])
									Đặt hàng
									@elseif ($order->status == App\Models\Order::STATUS['danggiaohang'])
									Đang giao hàng
									@elseif ($order->status == App\Models\Order::STATUS['dagiaohang'])
									Đã giao hàng
									@elseif ($order->status == App\Models\Order::STATUS['trahang'])
									Trả hàng
									@endif
								</strong>
							</td>
							<td class="border-0 align-middle text-center"><a href="{{ route('frontend.home.cancelOrder', $order->id) }}" class="text-dark"><i class="fa fa-trash"></i></a></td>
						</tr>
						@endforeach
						{{-- @if (Cart::count() > 0)
						<tr class="mr-top">
							<td></td>
							<td></td>
							<td colspan="2"> <b class="red-color"><i> Tổng giá : </i> {{ number_format(Cart::subTotal(0,0,'')) }} VNĐ</b></td>
						</tr>
						@endif --}}
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@endif
</div>
@endsection