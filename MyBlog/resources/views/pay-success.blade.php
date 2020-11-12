@extends('layouts/main_layout')
@section('content')
<div id="main-content-wp" class="pay-success clearfix text-center">
    <div class="wp-inner mx-auto">
        <img style="width: 100px;" class="mx-auto" src="{{url('public/images/icon-tick-v.png')}}" alt="">
        <h5>Cảm ơn quý khách đã mua hàng tại Ismart</h5>
        <p style="overflow:auto;">Tổng đài viên của Ismart sẽ liên hệ đến quý khách trong vòng <strong>5 phút</strong> để xác nhận đơn hàng </p>
        <p>xin cảm ơn quý khách đã cho chúng tôi được phục vụ</p>
        <div id="order_info" class="w-50 mx-auto mb-4">
            <div class="border">
                Thông tin đặt hàng
            </div>
            <div class="info d-flex border border-top-0" >
                <div class="w-50">
                    <p>Mã đơn hàng</p>
                    <p>Hình thức thanh toán</p>
                    <p>Họ tên khách hàng</p>
                    <p>Số điện thoại</p>
                </div>
                <div class="w-50">
                    <p class="font-weight-bold">{{$order[0]->code}}</p>
                    @if($order[0]->payment=='payment-home')
                    <p class="font-weight-bold">Thanh toán tại nhà</p>
                    @else
                    <p class="font-weight-bold">Thanh toán tại cửa hàng</p>
                    @endif
                    <p class="font-weight-bold">{{$order[0]->customer_name}}</p>
                    <p class="font-weight-bold">{{$order[0]->phone}}</p>
                   
                </div>

            </div>
        </div>
        <div id="list_product" class="w-50 mx-auto clearfix mb-4">
            <div class="border">
                Sản phẩm đã mua
            </div>
            @foreach($order[0]->products as $item)
            <div class="info d-flex border border-top-0" >
                
                <div class="w-50">
                    <img style="width: 100px;" class="float-left" src="{{url('public/uploads/product/'.$item->options->product_img)}}" alt="">
                   <p>{{$item->name}}</p>
                   <p>Số lượng: {{$item->qty}}</p>
                </div>
                <div class="w-50">
                   <p>{{number_format($item->subtotal)}}đ</p>
                </div>

                
            </div>
            @endforeach

            
        </div>
        <a href="{{route('home')}}" class="btn btn-outline-success">Mua tiếp</a>



    </div>
</div>

@endsection