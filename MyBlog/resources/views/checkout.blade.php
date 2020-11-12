@extends('layouts/main_layout')
@section('content')
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="customer-info-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin khách hàng</h1>
            </div>
            <div class="section-detail">
                <form method="POST" action="{{route('cart.checkout_process')}}" name="form-checkout">
                    @csrf
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname" class="form-control">
                            @error('fullname')
                            <p class="text-danger">{{$errors->first('fullname')}}</p>

                            @enderror
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Danh xưng</label>
                            <input type="radio" name="gender" id="male" value="male">
                            <label for="male" class="d-inline-block">Anh</label>
                            <input type="radio" name="gender" id="female" value="female">
                            <label for="female" class="d-inline-block">Chị</label>
                            @error('gender')
                            <p class="text-danger">{{$errors->first('gender')}}</p>

                            @enderror

                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone" class="form-control">
                            @error('phone')
                            <p class="text-danger">{{$errors->first('phone')}}</p>
                            @enderror
                        </div>
                        <div class="form-col fl-right pr-0">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                            @error('email')
                            <p class="text-danger">{{$errors->first('email')}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="province" class="mb-0">Thành phố/Tỉnh</label>
                            <select name="province" id="province" class="form-control">
                                <option value="">Chọn tỉnh/thành phố</option>
                                @foreach($list_provinces as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>

                                @endforeach
                            </select>
                            @error('province')
                            <p class="text-danger">{{$errors->first('province')}}</p>
                            @enderror
                        </div>
                        <div class="form-col fl-left">
                            <label for="district" class="mb-0">Quận/Huyện</label>
                            <select name="district" id="district" class="form-control">
                                <option value="">Chọn quận/huyện</option>
                            </select>
                            @error('district')
                            <p class="text-danger">{{$errors->first('district')}}</p>
                            @enderror
                        </div>
                        <div class="form-col fl-left">
                            <label for="ward" class="mb-0">Xã</label>
                            <select name="ward" id="ward" class="form-control">
                                <option value="">Chọn xã</option>
                            </select>
                            @error('ward')
                            <p class="text-danger">{{$errors->first('ward')}}</p>
                            @enderror
                        </div>
                        <div class="form-col fl-left pr-0">
                            <label for="address" class="mb-0">Số nhà-tên đường</label>
                            <input type="text" name="address" id="address" class="form-control">
                            @error('address')
                            <p class="text-danger">{{$errors->first('address')}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">

                        <label for="notes">Ghi chú</label>
                        <textarea name="note" class="form-control" rows="6"></textarea>

                    </div>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment" value="direct-payment">
                                <label for="direct-payment">Thanh toán tại cửa hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment" value="payment-home" checked="checked">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                        </ul>
                       
                   
            </div>
            <div class="place-order-wp clearfix">
                <input type="submit" id="order-now" value="Đặt hàng">
            </div>
            </form>
        </div>
    </div>
    <div class="section" id="order-review-wp">
        <div class="section-head">
            <h1 class="section-title">Thông tin đơn hàng</h1>
        </div>
        <div class="section-detail">
            <table class="shop-table">
                <thead>
                    <tr>
                        <td><strong>Sản phẩm</strong> </td>
                        <td><strong>Tổng</strong> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach(Cart::content() as $item)
                    <tr class="cart-item">
                        <td class="product-name">{{$item->name}}<strong class="product-quantity">x {{$item->qty}}</strong></td>
                        <td class="product-total">{{$item->subtotal()}}đ</td>
                    </tr>
                    @endforeach


                </tbody>
                <tfoot>
                    <tr class="order-total">
                        <td>Tổng đơn hàng:</td>
                        <td>
                            <h4 class="total-price text-danger">{{Cart::total()}}đ</h4>
                        </td>
                    </tr>
                </tfoot>
            </table>


        </div>
    </div>
</div>
</div>
@endsection