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
            <h1 class="m-0 text-dark">Danh sách đơn đặt hàng</h1>
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
                            <th width="5%">Mã đơn (ID)</th>
                            <th width="15%">Tên Khách hàng</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Địa chỉ</th>
                            <th>
                                Status
                            </th>
                            <th>Tổng giá</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr class="">
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->address }}</td>
                            <td>
                                @if ($order->status == 0)
                                Hủy Hàng
                                @elseif ($order->status == 1)
                                Đặt Hàng
                                @elseif ($order->status == 2)
                                Đang Giao Hàng 
                                @elseif ($order->status == 3)
                                Đã Giao Hàng
                                @elseif ($order->status == 4)
                                Trả hàng
                                @endif
                            </td>
                            <td>{{ number_format($order->total_price) }} VNĐ</td>
                            <td>
                                <a href="{{ route('backend.order.showDetail', $order->id) }}" class="btn btn-secondary"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                <a href="{{ route('backend.order.editOrder', $order->id) }}" class="btn btn-danger"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                {{-- @if ($order->status == 2)
                                <a href="{{ route('backend.order.success', $order->id) }}" class="btn btn-primary"><i class="fa fa-check-square" aria-hidden="true"></i></a> 
                                @endif  --}}             
                            </td>       
                        </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <th width="5%">Mã đơn (ID)</th>
                            <th width="15%">Tên Khách hàng</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Địa chỉ</th>
                            <th>
                                Status
                            </th>
                            <th>Tổng giá</th>
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection
@section('foot-js')
<script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
    $('#example').DataTable();
} );
</script>
@endsection