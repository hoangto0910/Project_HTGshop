@extends('backend.layouts.master')
@section('title-1')
Home Page
@endsection
@section('title-header')
Home
@endsection
@section('title-header')
Home
@endsection
@section('card-content')
<!-- Content Header -->
<div class="container-fluid">
</div><!-- /.container-fluid -->
<!-- Content -->
<div class="container-fluid">
    <!-- Main row -->
    <div class="row">
        <div class="col-12">
            <div class="">
                <div class="card-body">
                    <h3>Welcome to HomePage : {{ Auth::user()->name }}</h3>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
@endsection