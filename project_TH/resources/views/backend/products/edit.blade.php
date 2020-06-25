@extends('backend.layouts.master')
@section('title-1')
Edit Products
@endsection
@section('title-header')
Products
@endsection
@section('title-header')
Products
@endsection
@section('card-content')
<!-- Content Header -->
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sửa thông tin sản phẩm</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                <li class="breadcrumb-item active">Sửa sản phẩm</li>
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
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach  
                    </ul>
                </div>
                @endif
                <div class="card-header">
                    <h3 class="card-title">Sửa thông tin sản phẩm</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('backend.product.update', $product->id) }}">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="" placeholder="Điền tên sản phẩm" name="name" value="{{ $product->name }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Giá Gốc</label>
                                    <input type="text" class="form-control" name="origin_price" value="{{ $product->origin_price }}" placeholder="Điền giá Gốc">
                                    @error('origin_price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Giá Khuyến mãi</label>
                                    <input type="text" class="form-control" name="sale_price" value="{{ $product->sale_price }}" placeholder="Điền giá Khuyến mãi">
                                    @error('sale_price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả sản phẩm</label>
                            <textarea class="textarea" id="summernote" name="content" value="{{ $product->content }}" placeholder="Place some text here"
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                            @error('content')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label>Danh mục sản phẩm</label>
                                <select class="form-control select2" name="category_id" style="width: 100%;">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Thương hiệu sản phẩm</label>
                                <select class="form-control select2" name="brandname_id" style="width: 100%;">
                                    @foreach ($brandnames as $brandname)
                                    <option value="{{ $brandname->id }}" @if($brandname->id == $product->brandname_id) selected @endif>{{ $brandname->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái sản phẩm</label>
                                <select class="form-control select2" name="status" style="width: 100%;">
                                    <option value="0" @if(0 == $product->status) selected @endif>Đang nhập</option>
                                    <option value="1" @if(1 == $product->status) selected @endif>Mở bán</option>
                                    <option value="2" @if(2 == $product->status) selected @endif>Hết hàng</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Thời hạn bảo hành</label>
                                <input type="text" class="form-control" placeholder="Điền Thời hạn bảo hành" name="guarantee" value="{{ $product->guarantee }}">
                                @error('guarantee')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Chính sách sản phẩm</label>
                                <input type="text" class="form-control" placeholder="Điền Thời hạn bảo hành" name="policy" value="{{ $product->policy }}">
                                @error('policy')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Hình ảnh sản phẩm</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-default"><a href="{{ route('backend.product.index') }}">Huỷ bỏ</a></button>
                            <button type="submit" class="btn btn-sucess">Sửa luôn</button>
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script> --}}
<script>
    $(document).ready(function() {
      $('#summernote').summernote();
      $("#summernote").summernote('editor.pasteHTML',$("#summernote").data("content"));
  });
</script>
@endsection