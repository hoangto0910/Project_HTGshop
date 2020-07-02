@extends('backend.layouts.master')
@section('title-1')
Users
@endsection
@section('title-header')
Users
@endsection
@section('title-header')
Users
@endsection
@section('card-content')
<!-- Content Header -->
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sửa người dùng</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Người dùng</a></li>
                <li class="breadcrumb-item active">Sửa</li>
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
                    <h3 class="card-title">Sửa người dùng</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('backend.user.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="" placeholder="Tên người dùng">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone</label>
                            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" id="" placeholder="sdt người dùng">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <input type="text" name="address" value="{{ $user->address }}" class="form-control" id="" placeholder="địa chỉ người dùng">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email"value="{{ $user->email }}" class="form-control" id="" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label>Quyền</label>
                            <select class="form-control select2" name="role" style="width: 100%;">
                                <option value="2">Content</option>
                                <option value="3">Sale-person</option>
                                <option value="4">User</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-default">Huỷ bỏ</button>
                        <button type="submit" class="btn btn-sucess">Sửa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
@endsection