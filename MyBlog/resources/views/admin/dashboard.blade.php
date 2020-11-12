@extends('layouts/admin_layout')
@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <div class="col">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                <div class="card-body">
                    <h5 class="card-title">{{$num_success_order}}</h5>
                    <p class="card-text">Đơn hàng thành công</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐANG XỬ LÝ</div>
                <div class="card-body">
                    <h5 class="card-title">{{$num_process_order}}</h5>
                    <p class="card-text">Đơn hàng đang xử lý</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">DOANH SỐ</div>
                <div class="card-body">
                    <h5 class="card-title">{{number_format($sales)}}đ</h5>
                    <p class="card-text">Doanh số hệ thống</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG HỦY</div>
                <div class="card-body">
                    <h5 class="card-title">125</h5>
                    <p class="card-text">Số đơn bị hủy </p>
                </div>
            </div>
        </div>
    </div>
    <!-- end analytic  -->
    <div class="card">
        <div class="card-header font-weight-bold">
            ĐƠN HÀNG MỚI
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Mã</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Tổng tiền </th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                   if(!isset($_GET['page'])||$_GET['page']==1)
                   {
                       $count=1;
                   }
                   else
                   {
                       $count=($_GET['page']-1)*$num_per_page+1;
                   }
                   ?>
                    @foreach($list_orders as $item)
                    <tr>
                        <th scope="row">{{$count}}</th>
                        <td>{{$item->code}}</td>
                        <td>{{$item->customer_name}}</td>
                        <td>{{number_format($item->total)}}₫</td>
                        <td>
                            @if($item->status==0)
                            <span class="badge badge-warning">Đang xử lý</span>

                            @else
                            <span class="badge badge-success">Hoàn thành</span>

                            @endif
                        </td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <a href="{{route('admin.order.detail',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @php $count++; @endphp
                    
                    @endforeach
                    
                   
                </tbody>
            </table>
           {{$list_orders->links()}}
        </div>
    </div>

</div>

@endsection