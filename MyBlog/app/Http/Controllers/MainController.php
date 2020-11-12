<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCat;
use App\ProductSubCat;
use Illuminate\Http\Request;

class MainController extends Controller
{
    function index(Request $request)
    {
        
        $list_cats_subcats=ProductCat::all();
        $list_product_by_cat=array();
      
        $hot_sale_products=Product::orderBy('purchase')->limit(5)->get();
        foreach($list_cats_subcats as $item)
        {
            $item['product_by_cat']=Product::where('cat_id',$item->id)->orderBy('id','desc')->limit(8)->get();
            $item['subcats']=ProductSubCat::where('cat_id',$item->id)->get();
        }
        $request->session()->put('list_cats_subcats',$list_cats_subcats);
        return view('home',compact('list_cats_subcats','hot_sale_products'));
    }
}
