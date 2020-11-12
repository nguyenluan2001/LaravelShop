@extends('layouts/admin_layout')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div id="customer_info" class="mb-3">
                <h3>THÔNG TIN KHÁCH HÀNG</h3>
                <div class="pl-3">
                    <strong>Mã đơn hàng</strong>
                    <p>{{$order->code}}</p>

                </div>
                <div class="pl-3">
                    <strong>Họ tên khách hàng</strong>
                    <p>{{$order->customer_name}}</p>

                </div>
                <div class="pl-3">
                    <strong>Địa chỉ</strong>
                    <p>{{$order->address.", ".$order->ward.", ".$order->district.", ".$order->province}}</p>
                    
                </div>
                <div class="pl-3">
                    <strong>Số điện thoại</strong>
                    <p>{{$order->phone}}</p>
                    
                </div>
                <div class="pl-3">
                    <strong>Email</strong>
                    <p>{{$order->email}}</p>
                    
                </div>
                <div class="pl-3">
                    <strong>Thông tin vận chuyển</strong>
                    @if($order->payment=='direct-payment')
                    <p>Thanh toán tại cửa hàng</p>

                    @else
                    <p>Thanh toán tại nhà</p>

                    @endif
                </div>
                <div class="pl-3">
                    <strong class="d-block">Tình trạng đơn hàng</strong>
                    <form action="{{route('admin.order.update_status',$order->id)}}" method="post">
                        @csrf
                    <select name="status" id="" >
                        <option value="0" <?php if($order->status==0) echo "selected='selected'"?>>Đang xử lí</option>
                        <option value="1" <?php if($order->status==1) echo "selected='selected'"?>>Hoàn thành</option>
                    </select>
                    <input type="submit" class="btn btn-primary" value="Cập nhật đơn hàng"></input>
                    </form>
                   
                    
                </div>
                
            </div>
            <table class="table table-striped table-checkall">
            <h3>Sản phẩm đơn hàng</h3>

                <thead>
                    <tr>

                        <th scope="col">#</th>
                        <th scope="col">Ảnh sản phẩm</th>
                        <th scope="col">Đơn giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Màu sắc</th>
                        <th scope="col">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count=1; @endphp
                    @foreach($order['detail'] as $item)
                    <tr>
                        <td>{{$count}}</td>
                        <td><img style="width: 100px;" src="{{url('public/uploads/product/'.$item->product_img)}}" alt=""></td>
                        <td>
                            {{number_format($item->price)}}đ
                        </td>
                        <td>{{$item->qty_prd}}</td>
                        <td>Vàng</td>
                        <td>{{number_format($item->subtotal)}}</td>

                    </tr>
                    @php $count++; @endphp

                    @endforeach



                </tbody>
            </table>
            <div id="order_info">
                <h3>Giá trị đơn hàng</h3>
                <p>Số lượng: {{$order->total_qty}}</p>
                <p>Tổng tiền: {{number_format($order->total)}}đ</p>
            </div>

        </div>
    </div>


</div>
@endsection