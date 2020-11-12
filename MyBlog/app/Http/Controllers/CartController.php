<?php

namespace App\Http\Controllers;

use App\DetailOrder;
use App\District;
use App\Order;
use App\Product;
use App\Province;
use App\Ward;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use  Gloudemans\Shoppingcart\Facades\Cart;

include(app_path() . '\PHPMAILER\email.php');

class CartController extends Controller
{
    function show()
    {
        return view('cart');
    }
    function add( $id)
    {

        $product = Product::find($id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->product_name,
            'price' => $product->price,
            'qty' => 1,
            'options' => [
                'product_img' => $product->product_img,
                'slug' => $product->slug,
                'product_code' => $product->product_code,
            ]
        ]);
        return redirect()->route('cart.show');
    }
    function add_more_1(Request $request, $id)
    {

        $product = Product::find($id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->product_name,
            'price' => $product->price,
            'qty' => $request->num_order,
            'options' => [
                'product_img' => $product->product_img,
                'slug' => $product->slug,
                'product_code' => $product->product_code,
            ]
        ]);
        return redirect()->route('cart.show');
    }
    function qty_ajax(Request $request)
    {
        Cart::update($request->rowid, $request->qty);
        $subtotal = Cart::get($request->rowid)->subtotal(0, 'đ');
        $total = Cart::total(0);
        $arr = [
            'qty' => Cart::get($request->rowid)->qty,
            'subtotal' => $subtotal,
            'total' => $total
        ];
        $arr1=[
            "mot"=>1,
            "hai"=>2
        ];
        echo json_encode($arr);
    }
    function delete($rowId = 0)
    {
        if ($rowId != 0) {
            Cart::remove($rowId);
        } else {
            Cart::destroy();
        }
        return redirect()->route('cart.show');
    }
    function checkout()
    {
        $list_provinces = Province::all();
        return view('checkout', compact('list_provinces'));
    }
    function checkout_process(Request $request)
    {
        $request->validate(
            [
                'fullname' => 'required',
                'gender' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'province' => 'required',
                'district' => 'required',
                'ward' => 'required',
                'address' => 'required',
                'payment' => 'required'
            ],
            [
                'required' => ':attribute không được để trống'
            ],
            [
                'fullname' => 'Họ tên',
                'gender' => 'Giới tính',
                'phone' => 'Số điện thoại',
                'email' => 'Email',
                'province' => 'Tỉnh/Thành phố',
                'district' => 'Quận/Huyện',
                'ward' => 'Xã',
                'address' => 'Địa chỉ',
                'payment' => 'Phương thức thanh toán'
            ]
        );
        $order = new Order;
        $code = 'LA-' . Str::upper(Str::random(8));
        $order->code = $code;
        $order->customer_name = $request->fullname;
        $order->gender = $request->gender;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->province = Province::find($request->province)->name;
        $order->district = District::find($request->district)->name;
        $order->ward = Ward::find($request->ward)->name;
        $order->address = $request->address;
        $order->note = $request->note;
        $order->payment = $request->payment;
        $order->total = Cart::total(0, '', '');
        $total_qty = 0;
        foreach (Cart::content() as $item) {
            $total_qty += $item->qty;
        }
        $order->total_qty = $total_qty;
        $order->save();
        $order = Order::where('code', $code)->get();
        foreach (Cart::content() as $item) {
            $detail_order = new DetailOrder;
            $detail_order->order_id = $order[0]->id;
            $detail_order->product_id = $item->id;
            $detail_order->qty = $item->qty;
            $detail_order->subtotal = $item->subtotal(0, '', '');
            $detail_order->save();

            $product = Product::find($item->id);
            $product->purchase = $product->purchase + $item->qty;
            $product->qty = $product->qty - $item->qty;
            $product->save();
            $order[0]['products'] = Cart::content();
        }

        $url=url('resources\views\email.php');
        // return $order[0]->email;
        $content=file_get_contents($url);
        $list_order="";
        foreach(Cart::content() as $item)
        {
            $count=1;
            $price=number_format($item->price);
            $subtotal=number_format($item->subtotal);
            $list_order.="
            <tr>
            <td>{$count}</td>
            <td>{$item->name}</td>
            <td>{$item->qty}</td>
            <td>{$price}VND</td>
            <td>{$subtotal}VND</td>
        </tr>
            ";
            $count++;
        }
        
        $variables=array(
            "{{name}}"=>$request->fullname,
            "{{address}}"=>$order[0]->address.", ".$order[0]->ward.", ".$order[0]->district.", ".$order[0]->province,
            "{{phone}}"=>$request->phone,
            "{{email}}"=>$request->email,
            "{{payment}}"=>$order[0]->payment,
            "{{total}}"=>Cart::total(0,'.'),
            "{{list_order}}"=>$list_order
        );
        foreach($variables as $key=>$value)
        {
            $content=str_replace($key,$value,$content);
    
        }
    
       

        sendMail($request->email, 'ISMART', 'Thông báo đặt hàng thành công', $content, []);
        return redirect()->route('pay_success', $order[0]->code);

    }
    function pay_success($code)
    {
        $order = Order::where('code', $code)->get();
        $order[0]['products'] = Cart::content();
        return view('pay-success', compact('order'));
    }
    function district_ajax(Request $request)
    {
        $html = '';
        $districts = Province::find($request->id)->districts;
        foreach ($districts as $item) {
            $html .= "<option value='{$item->id}'>{$item->name}</option>";
        }
        echo $html;
    }
    function ward_ajax(Request $request)
    {
        $html = '';
        $wards = District::find($request->id)->wards;
        foreach ($wards as $item) {
            $html .= "<option value='{$item->id}'>{$item->name}</option>";
        }
        echo $html;
    }
}
