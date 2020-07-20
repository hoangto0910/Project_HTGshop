<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Electro - HTML Ecommerce Template</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}"/>

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}"/>
	<link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}"/>

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/nouislider.min.css') }}"/>

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/style.css') }}"/>
	{{-- <script>
		new WOW().init();
	</script> --}}
	@yield('css-page')
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style>
			.ul_child{
				display: none;
				position: absolute;
				z-index: 50;
				padding: 35px 7px;
				border-radius: 8px;
				background-image: url('https://wallpaperplay.com/walls/full/b/3/7/329976.jpg');
				background-size: cover;
				box-shadow: 0 0 1px 1px;
			}
			.li_parent:hover .ul_child{
				display: block;
				width: 520px;
				height: 260px;
			}
			.ul_child li{
				margin-bottom: 20px;
			}
			.cursor{
				cursor: pointer;
			}
			.color-red{
				color: #D31838;
			}
			.color-black{
				color: black;
			}
			.product-img img{
				height: 280px !important;
			}
			.product-name a{
				display: block;
				height: 60px;
			}
		</style>

	</head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +78 715 7928</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> Hoangto@gmail.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> Tổ 19 Lĩnh Nam Mai Động</a></li>
					</ul>
					<ul class="header-links pull-right">
						{{-- <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li> --}}
						@if (!Auth::check())
						<li class="cursor">
							<a data-toggle="modal" data-target="#loginModal">
								<i class="fa fa-user-o"></i> Đăng nhập
							</a>
							<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Đăng Nhập</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form id="login" method="POST" action="{{ route('frontend.home.login') }}">
												@csrf
												<div class="form-group">
													<label for="exampleInputEmail1">Địa chỉ email</label>
													<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập email" name="email">
													{{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Mật khẩu</label>
													<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Nhập mật khẩu" name="password">
												</div>
												{{-- <div class="form-group form-check">
													<input type="checkbox" class="form-check-input" id="exampleCheck1">
													<label class="form-check-label" for="exampleCheck1">Check me out</label>
												</div> --}}
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
												<button type="submit" class="btn btn-primary">Đăng Nhập</button>
											</form>
										</div>
										<div class="modal-footer">
											{{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Đăng nhập</button> --}}
										</div>
									</div>
								</div>
							</div>
						</li>
						@elseif (Auth::check())
						<li>
							<a href="{{ route('frontend.home.userProfile') }}">Xin chào:<i><b> {{ Auth::user()->name }}</b></i></a>
						</li>
						<li>
							<form action="{{ route('frontend.home.logout') }}" method="POST">
								@csrf
								@method('POST')
								<button type="submit" class="btn text-dark"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
							</form>
						</li>
						@endif
						@if (!Auth::check())
						<li class="cursor">

							<!-- Button trigger modal -->
							<a data-toggle="modal" data-target="#registerModal">
								<i class="fa fa-user-o"></i> Đăng Ký
							</a>

							<!-- Modal -->
							<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Đăng Ký</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form id="register" method="POST">
												@csrf
												<div class="form-group">
													<label>Họ tên</label>
													<input type="text" class="form-control" placeholder="Nhập họ tên" name="name">
												</div>
												<div class="form-group">
													<label for="exampleInputEmail1">Địa chỉ email</label>
													<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập email" name="email">
													{{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Mật khẩu</label>
													<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Nhập mật khẩu" name="password">
												</div>
												<div class="form-group">
													<label>Số điện thoại</label>
													<input type="text" class="form-control" placeholder="Nhập số điện thoại" name="phone">
												</div>
												<div class="form-group">
													<label>Địa chỉ</label>
													<input type="text" class="form-control" placeholder="Nhập địa chỉ" name="address">
												</div>
												{{-- <div class="form-group form-check">
													<input type="checkbox" class="form-check-input" id="exampleCheck1">
													<label class="form-check-label" for="exampleCheck1">Check me out</label>
												</div> --}}
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
												<button type="submit" class="btn btn-primary">Đăng Ký</button>
											</form>
										</div>
										<div class="modal-footer">
											{{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Đăng nhập</button> --}}
										</div>
									</div>
								</div>
							</div>
						</li>
						@endif
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="{{ route('frontend.home.index') }}" class="logo">
									<img src="../../frontend/img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">All Categories</option>
										<option value="1">Category 01</option>
										<option value="1">Category 02</option>
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
									<a href="{{ route('frontend.home.wishlist') }}">
										<i class="fa fa-heart-o"></i>
										<span>Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a href="{{ route('frontend.cart.index') }}" class="{{-- dropdown-toggle --}}" data-toggle="{{-- dropdown --}}" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Giỏ hàng</span>
										@if (Cart::count())
										<div class="qty">
											{{ Cart::count() }}
										</div>
										@endif
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											{{-- @foreach ($carts_dropdown as $product)
											<div class="product-widget">
												<div class="product-img">
													<img src="{{ asset("$product->options['cart']") }}" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">{{$product->name}}</a></h3>
													<h4 class="product-price"><span class="qty"></span>{{number_format($product->price)}}</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
											@endforeach --}}
											
											{{-- <div class="product-widget">
												<div class="product-img">
													<img src="../../frontend/img/product02.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div> --}}
										</div>
										<div class="cart-summary">
											<small>3 Item(s) selected</small>
											<h5>SUBTOTAL: $2940.00</h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
											<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->
		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav main">
						<li class="active"><a href="{{ route('frontend.home.index') }}">Trang chủ</a></li>
						<li><a href="{{ route('frontend.home.filter') }}">Bộ lọc</a></li>
						@foreach ($categories_parent as $category_parent)
						<li class="li_parent">
							<a href="{{ route('frontend.home.showProductsCategory', $category_parent->id) }}">{{ $category_parent->name }}</a>
							<ul class="ul_child">
								@foreach ($categories_child as $category_child)
								@if ($category_child->parent_id == $category_parent->id)
								<a href="{{ route('frontend.home.showProductsCategory', $category_child->id) }}"><li>{{ $category_child->name }}</li></a>
								@endif
								@endforeach
							</ul>
						</li>
						@endforeach
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->