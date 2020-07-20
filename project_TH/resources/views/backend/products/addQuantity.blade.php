@extends('backend.layouts.master')
@section('title-1')
Nhập sản phẩm
@endsection
@section('title-header')
Nhập sản phẩm
@endsection
@section('title-header')
Nhập sản phẩm
@endsection
@section('card-content')
<!-- Content Header -->
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Nhâp sản phẩm vào kho</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                <li class="breadcrumb-item active">Nhập sản phẩm vào kho</li>
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
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('backend.product.storeQuantity', $product->id) }}">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                            <input type="text" class="form-control" id="" placeholder="Nhập số lượng sản phẩm" name="quantity" value="">
                            @error('quantity')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá gốc</label>
                            <input type="text" class="form-control" id="" placeholder="Nhập số lượng sản phẩm" name="origin_price" value="{{ $product->origin_price }}">
                            @error('origin_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá bán</label>
                            <input type="text" class="form-control" id="" placeholder="Nhập số lượng sản phẩm" name="sale_price" value="{{ $product->sale_price }}">
                            @error('sale_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Trạng thái sản phẩm</label>
                            <select class="form-control select2" name="status" style="width: 100%;">
                                <option value="0" @if(0 == $product->status) selected @endif>Đang nhập</option>
                                <option value="1" @if(1 == $product->status) selected @endif>Mở bán</option>
                                <option value="2" @if(2 == $product->status) selected @endif>Hết hàng</option>
                            </select>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-default"><a href="{{ route('backend.product.stockindex') }}">Huỷ bỏ</a></button>
                            <button type="submit" class="btn btn-sucess">Cập nhật hàng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
{{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script> --}}
{{-- <script>
    $(document).ready(function() {
      $('#summernote').summernote();
      $("#summernote").summernote('editor.pasteHTML',$("#summernote").data("content"));
  });
</script> --}}
@endsection
@section('head-css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('foot-js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
      $('#summernote').summernote();
      $("#summernote").summernote('editor.pasteHTML',$("#summernote").data("content"));
  });
</script>
@endsection