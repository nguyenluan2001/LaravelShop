<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    function index()
    {
        $num_success_order=Order::where('status','1')->count();
        $num_process_order=Order::where('status','0')->count();
        $sales=Order::where('status','1')->sum('total');
        $num_per_page=10;
        $list_orders=Order::orderBy('id','desc')->paginate($num_per_page);
        return view('admin/dashboard',compact('num_success_order','num_process_order','sales','list_orders','num_per_page'));
    }
}
