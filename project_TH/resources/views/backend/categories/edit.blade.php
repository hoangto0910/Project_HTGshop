@extends('backend.layouts.master')
@section('title-1')
Edit Category
@endsection
@section('title-header')
Header
@endsection
@section('title-header')
Categories
@endsection
@section('card-content')
<!-- Content Header -->
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sửa Danh mục</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Danh mục</a></li>
                <li class="breadcrumb-item active">Sửa Danh mục</li>
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
                    <h3 class="card-title">Sửa Danh mục</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('backend.category.update', $category->id) }}">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="card-body">
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Danh mục</label>
                            <input type="text" class="form-control" id="" placeholder="Điền tên Danh mục" name="name" value="{{ $category->name }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Parent_id</label>
                            <input type="text" class="form-control" id="" placeholder="Điền Parent_id" name="parent_id" value="{{ $category->parent_id }}">
                            @error('parent_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Depth(Độ sâu danh mục)</label>
                            <input type="text" class="form-control" id="" placeholder="Điền Độ sâu của danh mục" name="depth" value="{{ $category->depth }}">
                            @error('depth')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-default"><a href="{{ route('backend.category.index') }}">Huỷ bỏ</a></button>
                        <button type="submit" class="btn btn-sucess">Sửa danh mục</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row (main row) -->
</div>
@endsection