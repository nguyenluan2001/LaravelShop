<?php

namespace App\Http\Controllers;

use App\DetailOrder;
use App\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    function show()
    {
        $num_per_page=10;
        $list_orders=Order::orderBy('id','desc')->paginate($num_per_page);
        $num_success_order=Order::where('status','1')->count();
        $num_process_order=Order::where('status','0')->count();
        return view('admin/order/list-order',compact('list_orders','num_per_page','num_success_order','num_process_order'));
    }
    function detail($id)
    {
        $order=Order::find($id);
        $detail_prd=Order::find($id)->detail_orders;
        foreach($detail_prd as $item)
        {
            $order['detail']=DetailOrder::join('products','products.id','detail_orders.product_id')
            ->select('detail_orders.qty as qty_prd','detail_orders.subtotal','products.*')
           ->where('order_id',$id)->get();
        }
        return view('admin/order/detail-order',compact('order'));

    }
    function delete($id)
    {
        DetailOrder::where('order_id',$id)->delete();
        Order::find($id)->delete();
        return redirect()->route('admin.order.show');
    }
    function update_status(Request $request,$id)
    {
        $order=Order::find($id);
        $order->status=$request->status;
        $order->save();
        return redirect()->route('admin.order.show')->with('update_order_success','Cập nhật đơn hàng thành công');
    }
    function search(Request $request)
    {
        $key_word=$request->key_word;
        $num_success_order=Order::where('status','1')->count();
        $num_process_order=Order::where('status','0')->count();
        $list_orders=Order::where('customer_name','like',"%$key_word%")->get();
        return view('admin/order/list-order',compact('list_orders','num_success_order','num_process_order'));
    }
    function list_success_order()
    {
        $num_per_page=10;
        $num_success_order=Order::where('status','1')->count();
        $num_process_order=Order::where('status','0')->count();
        $list_orders=Order::where('status','1')->orderBy('id','desc')->paginate($num_per_page);
        return view('admin/order/list-order',compact('list_orders','num_per_page','num_success_order','num_process_order'));

    }
    function list_process_order()
    {
        $num_per_page=10;
        $num_success_order=Order::where('status','1')->count();
        $num_process_order=Order::where('status','0')->count();
        $list_orders=Order::where('status','0')->orderBy('id','desc')->paginate($num_per_page);
        return view('admin/order/list-order',compact('list_orders','num_per_page','num_success_order','num_process_order'));

    }
    function action(Request $request)// hàm thực hiện các tác vụ với danh sách các order
    {
        $action=$request->action;
        $check_list=$request->check_list;

        if($action==1)// nếu tác vụ là Đang xử lí
        {
            foreach($check_list as $key=>$value)
            {
                $order=Order::find($key);
               $order->status='0';
               $order->save();
            }
        }
         if($action==2)// nếu tác vụ là Hoàn thành
        {
            foreach($check_list as $key=>$value)
            {
                $order=Order::find($key);
                $order->status='1';
                $order->save();

            }
        }
         if($action==3)// nếu tác vụ là Xóa
        {
            foreach($check_list as $key=>$value)
            {
               Order::find($key)->delete();
            }
        }
        return redirect()->route('admin.order.show');

    }
}
