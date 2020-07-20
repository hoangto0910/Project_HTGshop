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
</style>
@endsection
@section('content')
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
							{{-- <th width="10%" scope="col" class="border-0 bg-light text-center">
								<div class="py-2 text-uppercase">Số lượng</div>
							</th> --}}
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
										<input type="number" value="{{ $item->qty }}">
										<span class="qty-up"><a href="">+</a></span>
										<span class="qty-down"><a href="">-</a></span>
									</div>
								</strong>
							</td>
							<td class="border-0 align-middle text-center"><strong>{{ number_format($item->price * $item->qty) }} VNĐ</strong></td>
							<td class="border-0 align-middle text-center"><a href="{{ route('frontend.cart.destroy', $item->rowId) }}" class="text-dark"><i class="fa fa-trash"></i></a></td>
						</tr>
						@endforeach
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
</div>
@endsection