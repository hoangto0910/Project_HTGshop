@extends('backend.layouts.master')
@section('title-1')
Orders
@endsection
@section('title-header')
Orders
@endsection
@section('title-header')
Orders
@endsection
@section('card-content')
<!-- Content Header -->
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Danh sách sản phẩm order</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Danh mục</a></li>
                <li class="breadcrumb-item active">Danh sách</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
<!-- Content -->
<div class="container-fluid">
    <!-- Main row -->
    <div class="row">

        <div class="col-12">
            <div class="card">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr class="">
                            <th width="7%">ID</th>
                            <th width="25%">Tên sản phẩm</th>
                            <th width="20%">Ảnh sản phẩm</th>
                            <th>
                                Số Lượng
                            </th>
                            <th>Giá Tiền</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_products as $order_product)
                        <tr class="">
                            <td>{{ $order_product->id }}</td>
                            <td>{{ $order_product->name }}</td>
                            <td class="text-center"><img src="{{ asset("$order_product->image") }}" class="product-image" alt=""></td>
                            <td>{{ $order_product->quantity }}</td>
                            <td>{{ number_format($order_product->price) }} VNĐ</td>
                            <td>
                                <a href="{{ route('frontend.home.showProduct', $order_product->product_id) }}" class="btn btn-secondary"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                {{-- <a href="" class="btn btn-primary"><i class="fa fa-check-square" aria-hidden="true"></i></a> --}}
                                <form action="{{ route("backend.order.destroyOrder_product", [$order_product->id, $order_product->order_id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </td>       
                        </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot>
                        <tr class="">
                            <th width="7%">ID</th>
                            <th width="25%">Tên sản phẩm</th>
                            <th>Ảnh sản phẩm</th>
                            <th>
                                Số Lượng
                            </th>
                            <th>Giá Tiền</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
@endsection
@section('head-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<style>
    .product-image{
        max-width: 50% !important;
        height: auto !important;
        border-radius: 8px;
    }
</style>
@endsection
@section('foot-js')
<script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
    $('#example').DataTable();
} );
</script>
@endsection