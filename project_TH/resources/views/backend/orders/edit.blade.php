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
            <h1 class="m-0 text-dark">Chỉnh sửa đơn hàng</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Đơn Hàng</a></li>
                <li class="breadcrumb-item active">Chỉnh Sửa</li>
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
                    <h3 class="card-title">Chỉnh sửa đơn Hàng</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('backend.order.updateOrder', $order->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Khách hàng</label>
                            <input type="text" name="name" value="{{ $order->name }}" class="form-control" id="" placeholder="Tên đơn hàng">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control select2" name="status" style="width: 100%;">
                                <option value="0" @if($order->status == 0) selected @endif>Hủy Hàng</option>
                                <option value="1" @if($order->status == 1) selected @endif>Đặt Hàng</option>
                                <option value="2" @if($order->status == 2) selected @endif>Đang Giao hàng</option>
                                <option value="3" @if($order->status == 3) selected @endif>Đã Giao hàng</option>
                                <option value="4" @if($order->status == 4) selected @endif>Trả Hàng</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="{{ route('backend.order.index') }}" class="btn btn-default">Huỷ bỏ</button>
                        <button type="submit" class="btn btn-sucess">Sửa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
@endsection