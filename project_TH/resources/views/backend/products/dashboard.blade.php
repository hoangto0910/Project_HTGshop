@extends('backend.layouts.master')
@section('title-1')
Admin Page
@endsection
@section('title-header')
Dashboard
@endsection
@section('title-header')
Dashboard
@endsection
@section('card-content')
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-4 col-6">
				<!-- small box -->
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ count($products) }}</h3>

						<p>Sản phẩm</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					<a href="{{ route('backend.product.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-4 col-6">
				<!-- small box -->
				<div class="small-box bg-success">
					<div class="inner">
						<h3>
							{{ number_format($budget) }}<sup style="font-size: 20px">VNĐ</sup>
						</h3>
						<p>Doanh thu Trong ngày</p>
					</div>
					<div class="icon">
						<i class="ion ion-stats-bars"></i>
					</div>
					<a href="{{ route('backend.order.orderToday') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-4 col-6">
				<!-- small box -->
				<div class="small-box bg-warning">
					<div class="inner">
						<h3>{{ count($users) }}</h3>

						<p>Người đăng ký hệ thống</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="{{ route('backend.user.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-4 col-6">
				<!-- small box -->
				<div class="small-box bg-danger">
					<div class="inner">
						<h3>{{ count($orders_process) }}</h3>

						<p>Đơn Hàng chờ xử lý</p>
					</div>
					<div class="icon">
						<i class="fa fa-spinner" aria-hidden="true"></i>
					</div>
					<a href="{{ route('backend.order.orderProcess') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-4 col-6">
				<!-- small box -->
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ count($orders) }}</h3>

						<p>Đơn Hàng thành công</p>
					</div>
					<div class="icon">
						<i class="fa fa-check-circle" aria-hidden="true"></i>
					</div>
					<a href="{{ route('backend.order.orderSuccess') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>


		
	</div>
</section>
<!-- /.content -->
{{-- </div> --}}
<!-- /.content-wrapper -->
@endsection