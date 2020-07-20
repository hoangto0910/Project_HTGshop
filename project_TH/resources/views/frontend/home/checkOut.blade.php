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
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<h3 class="breadcrumb-header">Checkout</h3>
				<ul class="breadcrumb-tree">
					<li><a href="#">Home</a></li>
					<li class="active">Checkout</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div class="col-md-7">
				<!-- Billing Details -->
				<div class="billing-details">
					<div class="section-title">
						<h3 class="title">Thông tin Khách Hàng</h3>
					</div>
					<form action="{{ route('frontend.cart.checkOut') }}" method="POST" id="form-submit">
						@csrf
						<div class="form-group">
							<input class="input" type="text" name="name" placeholder="Nhập họ tên" @if (Auth::check())
							value="{{ Auth::user()->name }}" 
							@endif>
							@error('name')
								<div class="text-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<input class="input" type="text" name="email" placeholder="Nhập email" @if (Auth::check())
							value="{{ Auth::user()->email }}" 
							@endif>
							@error('email')
								<div class="text-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<input class="input" type="email" name="phone" placeholder="Nhập số điện thoại" @if (Auth::check())
							value="{{ Auth::user()->phone }}" 
							@endif>
							@error('phone')
								<div class="text-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<input class="input" type="text" name="address" placeholder="Nhập địa chỉ nhận hàng" @if (Auth::check())
							value="{{ Auth::user()->address }}" 
							@endif>
							@error('address')
								<div class="text-danger">{{ $message }}</div>
							@enderror
						</div>
						{{-- <div class="form-group">
							<div class="input-checkbox">
								<input type="checkbox" id="create-account">
								<label for="create-account">
									<span></span>
									Create Account?
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
									<input class="input" type="password" name="password" placeholder="Enter Your Password">
								</div>
							</div>
						</div> --}}
					</form>
				</div>
				<!-- /Billing Details -->

				<!-- Shiping Details -->
				{{-- <div class="shiping-details">
					<div class="section-title">
						<h3 class="title">Shiping address</h3>
					</div>
					<div class="input-checkbox">
						<input type="checkbox" id="shiping-address">
						<label for="shiping-address">
							<span></span>
							Ship to a diffrent address?
						</label>
						<div class="caption">
							<div class="form-group">
								<input class="input" type="text" name="first-name" placeholder="First Name">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="last-name" placeholder="Last Name">
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="City">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="tel" placeholder="Telephone">
							</div>
						</div>
					</div>
				</div> --}}
				<!-- /Shiping Details -->

				<!-- Order notes -->
				{{-- <div class="order-notes">
					<textarea class="input" placeholder="Order Notes"></textarea>
				</div> --}}
				<!-- /Order notes -->
			</div>

			<!-- Order Details -->
			<div class="col-md-5 order-details">
				<div class="section-title text-center">
					<h3 class="title">Đơn hàng của bạn</h3>
				</div>
				<div class="order-summary">
					<div class="order-col">
						<div><strong>Sản phẩm</strong></div>
						<div><strong>Giá tiền</strong></div>
					</div>
					<div class="order-products">
						@foreach (Cart::content() as $product)
						<div class="order-col">
							<div>{{ $product->qty }}x {{$product->name}}</div>
							<div>{{number_format($product->qty * $product->price)}} VNĐ</div>
						</div>
						@endforeach
						{{-- <div class="order-col">
							<div>2x Product Name Goes Here</div>
							<div>$980.00</div>
						</div> --}}
					</div>
					<div class="order-col">
						<div>Vận chuyển</div>
						<div><strong>Miễn phí</strong></div>
					</div>
					<div class="order-col">
						<div><strong>Tổng tiền</strong></div>
						<div><strong class="order-total">{{number_format(Cart::subTotal(0,0,''))}}VNĐ</strong></div>
					</div>
				</div>
				<div class="payment-method">
					<div class="input-radio">
						<input type="radio" name="payment" id="payment-1">
						<label for="payment-1">
							<span></span>
							Giao hàng Tận nơi
						</label>
						<div class="caption">
							<p>Sản Phẩm sẽ được giao đến đúng địa chỉ theo thông tin khách hàng nhập, Thanh toán ngay sau khi nhận hàng</p>
						</div>
					</div>
					{{-- <div class="input-radio">
						<input type="radio" name="payment" id="payment-2">
						<label for="payment-2">
							<span></span>
							Cheque Payment
						</label>
						<div class="caption">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div>
					<div class="input-radio">
						<input type="radio" name="payment" id="payment-3">
						<label for="payment-3">
							<span></span>
							Paypal System
						</label>
						<div class="caption">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div> --}}
				</div>
				{{-- <div class="input-checkbox">
					<input type="checkbox" id="terms">
					<label for="terms">
						<span></span>
						I've read and accept the <a href="#">terms & conditions</a>
					</label>
				</div> --}}
				<a href="#" class="primary-btn order-submit submit-btn">Tiến hành đặt hàng</a>
			</div>
			<!-- /Order Details -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- NEWSLETTER -->
<div id="newsletter" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="newsletter">
					<p>Sign Up for the <strong>NEWSLETTER</strong></p>
					<form>
						<input class="input" type="email" placeholder="Enter Your Email">
						<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
					</form>
					<ul class="newsletter-follow">
						<li>
							<a href="#"><i class="fa fa-facebook"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-twitter"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-instagram"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-pinterest"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /NEWSLETTER -->
@endsection
@section('js-footer')
<script>
	$(document).ready(function(){
		$(".submit-btn").on('click', function(){
			$("#form-submit").submit();
		})
	})
</script>
@endsection