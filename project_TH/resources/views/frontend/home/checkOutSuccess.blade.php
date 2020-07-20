@extends('frontend.layouts.master')
@section('css-page')
<style>
	.mr-top{
		margin-top: 80px;
	}
	.mr-bottom{
		margin-bottom: 80px;
	}
</style>
@endsection
@section('content')
<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container mr-top mr-bottom">
		<!-- row -->
		<div class="row">
			<h3>Đặt hàng thành công ấn <a href="{{ route('frontend.home.index') }}">Vào đây</a> về trang chủ</h3>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->
@endsection