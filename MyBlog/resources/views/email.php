<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div id="wrapper" style="width: 800px;margin:0px auto">
        <h1 style="color:#dc3545;text-align:center">Cảm ơn bạn đã đặt hàng tại ISMART</h1>
        <h3 style="color:blue">Đơn hàng được giao đến</h3>

        <div id="info_customer" style="width:100%">
                <div id="name" style="width: 100%;display:flex" >
                    <strong style="display: block; width:50%" >Tên:</strong>
                    <strong style="display: block; width:50%">{{name}}</strong>

                </div>
                <div id="address"  style="width: 100%;display:flex">
                    <strong style="display: block; width:50%">Đại chỉ:</strong>
                    <strong style="display: block; width:50%">{{address}}</strong>
                </div>
                <div id="phone"  style="width: 100%;display:flex">
                    <strong style="display: block; width:50%">Số điện thoại:</strong>
                    <strong style="display: block; width:50%">{{phone}}</strong>
                </div>
                <div id="email"  style="width: 100%;display:flex" >
                    <strong style="display: block; width:50%">Email:</strong>
                    <strong style="display: block; width:50%">{{email}}</strong>
                </div>
                <div id="payment"  style="width: 100%;display:flex" >
                    <strong style="display: block; width:50%">Hình thức thanh toán:</strong>
                    <strong style="display: block; width:50%">{{payment}}</strong>
                </div>
        </div>

        <div id="info_order">
            <h3 style="color:blue">Chi tiết đơn hàng</h3>
            <table style="width: 100%; text-align:center;border-collapse:collapse;border:1px solid black">
                <thead>
                    <tr style="border:1px solid black">
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá thành</th>
                        <th>Thành tiền</th>
                    </tr>

                </thead>
                <tbody>
                   {{list_order}}
                    
                </tbody>
            </table>
            <div style="display:flex;justify-content:space-between;">
                <p  style="font-size: 20px;font-weight:bold">Tổng cộng: </p>
                <p  style="font-size: 20px;color:#dc3545;font-weight:bold"> {{total}}VND</p>
            </div>
            <p>Mọi chi tiết xin liên hệ hotline: 0916225150</p>


        </div>

    </div>


</body>

</html>