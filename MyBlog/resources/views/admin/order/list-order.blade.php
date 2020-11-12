@extends('layouts/admin_layout')
@section('content')
<div id="content" class="container-fluid">
    @if(session('update_order_success'))
    <div class="alert alert-success">{{session('update_order_success')}}</div>
    @endif
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách đơn hàng</h5>
            <div class="form-search form-inline">
                <form action="{{route('admin.order.search')}}" class="d-flex">
                    @csrf
                    <input type="text" class="form-control form-search" name="key_word" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{route('admin.order.list_success_order')}}" class="text-primary">Hoàn thành<span class="text-muted">({{$num_success_order}})</span></a>
                <a href="{{route('admin.order.list_process_order')}}" class="text-primary">Đang xử lí<span class="text-muted">({{$num_process_order}})</span></a>
                <a href="" class="text-primary">Đơn hàng hủy<span class="text-muted">(20)</span></a>
            </div>
            <form action="{{route('admin.order.action')}}" method="post">
                @csrf
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" id="" name="action">
                        <option>Chọn</option>
                        <option value="1">Đang xử lí</option>
                        <option value=2>Hoàn thành</option>
                        <option value="3">Xóa</option>
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Mã</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!isset($_GET['page']) || $_GET['page'] == 1) {
                            $count = 1;
                        } else {
                            $count = ($_GET['page'] - 1) * $num_per_page + 1;
                        }
                        ?>

                        @foreach($list_orders as $item)


                        <tr>
                            <td>
                                <input type="checkbox" name="check_list[<?php echo $item->id ?>]">
                            </td>
                            <td>{{$count}}</td>
                            <td>{{$item->code}}</td>
                            <td>
                                {{$item->customer_name}}
                            </td>
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
                                <a href="{{route('admin.order.delete',$item->id)}}" onclick="return confirm('Bạn có muốn xóa không?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @php $count++; @endphp

                        @endforeach



                    </tbody>
                </table>
            </form>

            @if( !app('request')->input('key_word'))
            {{$list_orders->links()}}
            @endif
        </div>
    </div>
</div>
@endsection