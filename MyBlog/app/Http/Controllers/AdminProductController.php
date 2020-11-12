<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCat;
use App\ProductSubCat;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
class AdminProductController extends Controller
{
    function show()
    {
        // Paginator::useBootstrap();
        $list_products=Product::orderBy('id','desc')->paginate(3);
        return view('admin/product/list-product',compact('list_products'));
    }
    function add()
    {
        $list_cats=ProductCat::all();
        return view('admin/product/add-product',compact('list_cats'));
    }
    function add_process(Request $request)
    {
        $product=new Product;
        $product->product_name=$request->product_name;
        $product->slug=Str::slug($request->product_name);
        $file=$request->file('product_img');
        $product->product_img=$file->getClientOriginalName();
        $file->move('public/uploads/product',$file->getClientOriginalName());

        $img=Image::make("public/uploads/product/{$file->getClientOriginalName()}")->fit(200,200);
        $img->save();
        
        $product->product_desc=$request->product_desc;
        $product->product_content=$request->product_content;
        $product->price=$request->price;
        $product->product_code=$request->product_code;
        $product->qty=$request->qty;
        $product->cat_id=$request->cat_id;
        $product->subcat_id=$request->subcat_id;
        $product->save();
        return redirect()->route('admin.product.show')->with('add_success','Thêm thành công');


    }
    function edit($id)
    {
        $product=Product::find($id);
        $list_cats=ProductCat::all();
        $list_subcats=ProductSubCat::where('id',$product->subcat_id)->get();

        return view('admin/product/edit-product',compact('product','list_cats','list_subcats'));
    }
    function edit_process(Request $request,$id)
    {

        $product=Product::find($id);
        $product->product_name=$request->product_name;
        $product->slug=Str::slug($request->product_name);
        if($request->hasFile('product_img'))
        {
            $file=$request->file('product_img');
            $product->product_img=$file->getClientOriginalName();
            $file->move('public/uploads/product',$file->getClientOriginalName());
            $img=Image::make("public/uploads/product/{$file->getClientOriginalName()}")->fit(200,200);
            $img->save();
        }
        else
        {
            $product->product_img=$product->product_img;

        }
        $product->product_desc=$request->product_desc;
        $product->product_content=$request->product_content;
        $product->price=$request->price;
        $product->product_code=$request->product_code;
        $product->qty=$request->qty;
        $product->cat_id=$request->cat_id;
        $product->subcat_id=$request->subcat_id;
        $product->save();
        return redirect()->route('admin.product.edit',$id)->with('edit_success','Chỉnh sửa thành công');
    }
    function delete($id)
    {
        Product::find($id)->delete();
        return redirect()->route('admin.product.show')->with('delete_success','Đã xóa thành công');
    }
    function cat_add()
    {
        $list_cats_subcats=ProductCat::all();
        foreach($list_cats_subcats as $item)
        {
            $item['subcats']=ProductSubCat::where('cat_id',$item->id)->get();
        }
        return view('admin/product/add-cat',compact('list_cats_subcats'));
    }
    function cat_add_process(Request $request)
    {
        if($request->cat_id==0)
        {
            $cat=new ProductCat;
            $cat->product_cat_title=$request->title;
            $cat->save();
        }
        else
        {
            $subcat=new ProductSubCat;
            $subcat->product_sub_cat_title=$request->title;
            $subcat->cat_id=$request->cat_id;
            $subcat->save();
        }
        return redirect()->route('admin.product.cat.add')->with('add_success','Thêm thành công');
    }
    function cat_delete($cat_id)
    {
        $cat=ProductSubCat::where('cat_id',$cat_id)->get();
        if($cat->count()==0)
        {
            ProductCat::find($cat_id)->delete();
            return redirect()->route('admin.product.cat.add')->with('delete_success','Xóa thành công');

        }
        else
        {
            return redirect()->route('admin.product.cat.add')->with('delete_error','Không thể xóa được!!');

        }
    }
    function cat_edit($cat_id)
    {
        $cat=ProductCat::find($cat_id);
        $list_cats_subcats=ProductCat::all();
        foreach($list_cats_subcats as $item)
        {
            $item['subcats']=ProductSubCat::where('cat_id',$item->id)->get();
        }
        return view('admin/product/edit-cat',compact('cat','list_cats_subcats'));
    }
    function cat_edit_process(Request $request,$cat_id)
    {
        $cat=ProductCat::find($cat_id);
        $cat->product_cat_title=$request->title;
        $cat->save();
        return redirect()->route('admin.product.cat.add')->with('edit_success','Sửa thành công!!');


    }
    function subcat_delete($subcat_id)
    {
        ProductSubCat::find($subcat_id)->delete();
        return redirect()->route('admin.product.cat.add')->with('delete_success','Xóa thành công');


    }
    function subcat_edit($subcat_id)
    {
        $subcat=ProductSubCat::find($subcat_id);
        $list_cats_subcats=ProductCat::all();
        foreach($list_cats_subcats as $item)
        {
            $item['subcats']=ProductSubCat::where('cat_id',$item->id)->get();
        }
        return view('admin/product/edit-subcat',compact('subcat','list_cats_subcats'));
    }
    function subcat_edit_process(Request $request,$subcat_id)
    {
        $subcat=ProductSubCat::find($subcat_id);
        $subcat->product_sub_cat_title=$request->title;
        $subcat->save();
        return redirect()->route('admin.product.cat.add')->with('edit_success','Sửa thành công!!');

    }
    function product_subcat_ajax(Request $request)
    {
        $html="";
        $list_subcats=ProductSubCat::where('cat_id',$request->cat_id)->get();
        foreach($list_subcats as $item)
        {
            $html.="<option value='{$item->id}'>{$item->product_sub_cat_title}</option>";
        };
        echo $html;

    }
    function product_by_subcat($cat_id,$subcat_id)
    {
       $list_products=Product::where([['cat_id',$cat_id],['subcat_id',$subcat_id]])->paginate(5);
       return view('admin/product/list-product',compact('list_products'));
    }
}
