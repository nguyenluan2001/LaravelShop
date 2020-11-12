<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCat;
use App\ProductSubCat;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    function list_products_by_cat_subcat($cat_id,$subcat_id)
    {
            $list_products=Product::where([
                ['cat_id',$cat_id],
                ['subcat_id',$subcat_id]
                ])->orderBy('id','desc')->paginate(3);
                $list_cats_subcats=session('list_cats_subcats');
                $product_sub_cat_title=ProductSubCat::find($subcat_id)->product_sub_cat_title;
                $product_cat_title=ProductCat::find($cat_id)->product_cat_title;

       
            return view('category-product',compact('list_products','list_cats_subcats','product_sub_cat_title','product_cat_title','cat_id','subcat_id'));
    }
    function list_products_by_cat($cat_id)
    {
        $list_products=Product::where([
            ['cat_id',$cat_id],
           
            ])->paginate(1);
            $list_cats_subcats=session('list_cats_subcats');
  
            $product_cat_title=ProductCat::find($cat_id)->product_cat_title;

        return view('category-product',compact('list_products','list_cats_subcats','product_cat_title'));
    }
    function product_detail($id)
    {
        $product=Product::find($id);
        $list_cats_subcats=session('list_cats_subcats');
        return view('detail-product',compact('product','list_cats_subcats'));
    }
    function product_search(Request $request)
    {
        $txt=$request->search;
        $list_products=Product::where('product_name','like',"%$txt%")->paginate(2);
        $list_cats_subcats=session('list_cats_subcats');
        return view('search-product',compact('list_products','list_cats_subcats','txt'));
    }
    function product_filter(Request $request,$cat_id,$subcat_id)
    {
        $filter=$request->filter;
        
        if($filter==1)
        {
            $list_products=Product::orderBy('product_name')->where([['cat_id',$cat_id],['subcat_id',$subcat_id]])->paginate(2);

        }
        else if($filter==2)
        {
         $list_products=Product::orderBy('product_name','desc')->where([['cat_id',$cat_id],['subcat_id',$subcat_id]])->paginate(2);

        }
        else if($filter==3)
        {
            $list_products=Product::orderBy('price','desc')->where([['cat_id',$cat_id],['subcat_id',$subcat_id]])->paginate(2);


        }
        else if($filter==4)
        {
            $list_products=Product::orderBy('price')->where([['cat_id',$cat_id],['subcat_id',$subcat_id]])->paginate(2);

        }

        return redirect()->route('products',[$cat_id,$subcat_id])->with(['product_filter'=>$list_products,'filter'=>$filter]);

    }
}
