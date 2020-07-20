@extends('backend.layouts.master')
@section('title-1')
Stock
@endsection
@section('title-header')
Stock
@endsection
@section('title-header')
Stock
@endsection
@section('card-content')
<!-- Content Header -->
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý kho</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                <li class="breadcrumb-item active">Quản lý sản phẩm</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
<!-- Content -->
<div class="container-fluid">
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th width="25%">Name</th>
                            <th width="20%">Ảnh</th>
                            <th>
                                Số lượng
                            </th>
                            <th>Giá gốc</th>
                            <th>Giá bán</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr class="text-center">
                            <td>{{ $product->name }}</td>
                            <td><img src="{{ asset("$product->image") }}" class="product-image" alt=""></td>
                            <td>
                                @if ($product->quantity == 0)
                                    Hết hàng
                                @elseif ($product->quantity > 0)
                                    {{ $product->quantity }}
                                @endif
                            </td>
                            <td>{{ number_format($product->origin_price) }}</td>
                            <td>{{ number_format($product->sale_price) }}</td>
                            <td>
                                @if ($product->status == App\Models\Product::STATUS['dangnhap'])
                                Đang nhập
                                @elseif ($product->status == App\Models\Product::STATUS['moban'])
                                Mở bán
                                @elseif ($product->status == App\Models\Product::STATUS['hethang'])
                                Hết hàng
                                @endif
                            </td>
                            <td><a href="{{ route('backend.product.addQuantity', $product->id) }}" class="btn btn-info"><i class="fa fa-plus-square" aria-hidden="true"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá gốc</th>
                            <th>Giá bán</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
        </div>
    </div>
    <!-- /.row (main row) -->
</div>
@endsection
@section('head-css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
      $('#summernote').summernote();
      $("#summernote").summernote('editor.pasteHTML',$("#summernote").data("content"));
  });
</script>
@endsection