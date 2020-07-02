 {{-- {{ dd($productConfigs) }} --}}
 @extends('backend.layouts.master')
 @section('title-1')
 Products
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
            @can('admins')
            <h2 class="m-0 text-dark"><a href="{{ route('backend.product.create') }}" class="btn btn-success">Thêm mới sản phẩm</a></h2>
            @endcan
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
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
                <div class="card-header">
                    <h3 class="card-title">Sản phẩm mới nhập</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th width="20%">Tên sản phẩm</th>
                                {{-- <th>Thông số</th> --}}
                                <th>Ảnh đại diện</th>
                                <th>Thời gian</th>
                                <th>Status</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                {{-- <td>
                                    @foreach (json_decode($product->config) as $config)
                                    <b>{{ $config->key }}</b> : {{ $config->value }} <br> 
                                    @endforeach
                                </td> --}}
                                <td><img width="100px" height="100px" src='{{ asset("$product->image") }}' alt=""></td>  
                                <td>{{ $product->updated_at }}</td>
                                <td>
                                    @if ($product->status == 0)
                                    Đang Nhập
                                    @elseif($product->status == 1)
                                    Mở bán
                                    @elseif($product->status == 2)
                                    Hết Hàng
                                    @endif
                                </td>
                                <td>
                                    @can('update', $product)                                
                                    <a href="{{ route('backend.product.edit', $product->id) }}" class="btn btn-primary">Sửa</a>
                                    @endcan
                                    
                                    <a href="{{ route('frontend.home.showProduct', $product->id) }}" class="btn btn-secondary">Chi tiết</a>
                                    <a href="{{ route('backend.product.showImages', $product->id)  }}" class="btn btn-primary">Xem ảnh</a>
                                    @can('admins')
                                    <form action="{{ route('backend.product.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $products->links() !!}

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
@endsection