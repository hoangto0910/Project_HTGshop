@extends('frontend.layouts.master')
@section('css-page')
<style>
	.mr-top{
		margin-top: 80px;
	}
	.mr-bottom{
		margin-bottom: 80px;
	}
	.border-img{
		border-radius: 10px;
	}
	.red-color{
		color: #D10024;
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
				<h3 class="breadcrumb-header">Giỏ Hàng</h3>
				<ul class="breadcrumb-tree">
					<li><a href="#">Trang chủ</a></li>
					<li class="active">Giỏ hàng</li>
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

			<!-- Shopping cart table -->
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th scope="col" class="border-0 bg-light">
								<div class="p-2 px-3 text-uppercase">Sản Phẩm</div>
							</th>
							<th width="10%" scope="col" class="border-0 bg-light text-center">
								<div class="py-2 text-uppercase">Số lượng</div>
							</th>
							<th scope="col" class="border-0 bg-light text-center">
								<div class="py-2 text-uppercase">Giá tiền</div>
							</th>
							<th scope="col" class="border-0 bg-light text-center">
								<div class="py-2 text-uppercase">Xóa Sản phẩm</div>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($items as $item)
						<tr>
							<th scope="row" class="border-0">
								<div class="p-2">
									<img src="{{ $item->options['path'] }}" class="border-img" alt="" width="70" class="img-fluid rounded shadow-sm">
									<div class="ml-3 d-inline-block align-middle">
										<h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">{{$item->name}}</a></h5><span class="text-muted font-weight-normal font-italic d-block">Danh mục : {{ $item->options['category_name'] }}</span>
									</div>
								</div>
							</th>
							<td class="border-0 align-middle text-center">
								<strong>
								<div class="input-number">
									<input type="number" value="{{ $item->qty }}"><a href="{{ route('frontend.cart.plusQuantity', [$item->rowId, $item->qty, $item->price]) }}">
									<span class="qty-up">+</span></a>
									<a href="{{ route('frontend.cart.decreaseQuantity', [$item->rowId, $item->qty]) }}"><span class="qty-down">-</span></a>
								</div>
								{{-- <a href="{{ route('frontend.cart.plusQuantity', [$item->rowId, $item->qty, $item->price]) }}" class="btn btn-primary">+</a> {{ $item->qty }} <a href="{{ route('frontend.cart.decreaseQuantity', [$item->rowId, $item->qty]) }}" class="btn btn-danger">-</a> --}}</strong>
							</td>
							<td class="border-0 align-middle text-center"><strong>{{ number_format($item->price * $item->qty) }} VNĐ</strong></td>
							<td class="border-0 align-middle text-center"><a href="{{ route('frontend.cart.destroy', $item->rowId) }}" class="text-dark"><i class="fa fa-trash"></i></a></td>
						</tr>
						@endforeach
						@if (Cart::count() > 0)
						<tr class="mr-top">
							<td></td>
							<td></td>
							<td colspan="2"> <b class="red-color"><i> Tổng giá : </i> {{ number_format(Cart::subTotal(0,0,'')) }} VNĐ</b></td>
						</tr>
						@endif
					</tbody>
				</table>
				@if(Cart::count() == 0)
				<div class="mr-top">
					<b><i>Không có sản phẩm nào trong giỏ hàng</i></b>
				</div>
				@endif
			</div>
			<!-- End -->
		</div>
	</div>
	<a href="{{ route('frontend.home.index') }}" class="btn btn-danger mr-top">Quay lại</a>
	@if (Cart::count() > 0)
		<a href="{{ route('frontend.cart.viewCheckOut') }}" class="btn btn-primary mr-top">Đặt hàng</a>
	@endif

	{{-- <div class="row py-5 p-4 bg-white rounded shadow-sm mr-top mr-bottom">
		<div class="col-lg-6">
			<div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupon code</div>
			<div class="p-4">
				<p class="font-italic mb-4">If you have a coupon code, please enter it in the box below</p>	
				<div class="input-group mb-4 border rounded-pill p-2">
					<input type="text" placeholder="Apply coupon" aria-describedby="button-addon3" class="form-control border-0">
					<div class="input-group-append border-0">
						<button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Apply coupon</button>
					</div>
				</div>
			</div>
			<div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions for seller</div>
			<div class="p-4">
				<p class="font-italic mb-4">If you have some information for the seller you can leave them in the box below</p>
				<textarea name="" cols="30" rows="2" class="form-control"></textarea>
			</div>
		</div> --}}
			{{-- <div class="col-lg-6">
				<div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
				<div class="p-4">
					<p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p>
					<ul class="list-unstyled mb-4">
						<li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Order Subtotal </strong><strong>$390.00</strong></li>
						<li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>$10.00</strong></li>
						<li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tax</strong><strong>$0.00</strong></li>
						<li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
							<h5 class="font-weight-bold">$400.00</h5>
						</li>
					</ul><a href="#" class="btn btn-dark rounded-pill py-2 btn-block">Procceed to checkout</a>
				</div>
			</div> --}}
		{{-- </div> --}}

	</div>
	@endsection