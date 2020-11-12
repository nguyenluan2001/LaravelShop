<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostCat;
use App\PostSubCat;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPostController extends Controller
{
    function cat_add()
    {
        $list_cats_subcats=PostCat::all();
        foreach($list_cats_subcats as $item)
        {
            $item['subcat']=PostSubCat::where('cat_id',$item->id)->get();
        }
        return view('admin/post/add-cat',compact('list_cats_subcats'));
    }
    function cat_add_process(Request $request)
    {
        if($request->cat_id!=0)
        {
           $sub_cat=new PostSubCat;
           $sub_cat->title=$request->title;
           $sub_cat->slug=Str::slug($request->title);
           $sub_cat->cat_id=$request->cat_id;
           $sub_cat->save();
        }
        else
        {
            $cat=new PostCat;
            $cat->title=$request->title;
            $cat->slug=Str::slug($request->title);
            $cat->save();
        }
        return redirect()->route('admin.post.cat.add')->with('add_success','Thêm thành công');
    }
    function post_add()
    {
        $list_cats=PostCat::all();
        return view('admin/post/add-post',compact('list_cats'));
    }
    function subcat_process(Request $request)
    {
         $list_subcats=PostSubCat::where('cat_id',$request->cat_id)->get();
         $html="";
         foreach($list_subcats as $item)
         {
             $html.="<option value='{$item->id}'>{$item->title}</option>";
         }
         echo $html;
    }
    function post_add_process(Request $request)
    {
        $post=new Post;
        $post->post_title=$request->post_title;
        $post->slug=Str::slug($request->post_title);
        $post->post_desc=Str::of($request->post_title)->limit(20);
        $file=$request->file('post_img');
        $post->post_img=$file->getClientOriginalName();
        $file->move('public/uploads/post',$file->getClientOriginalName());
        $img=Image::make("public/uploads/post/{$file->getClientOriginalName()}")->fit(200,200);
        $img->save();
        $post->user_id=Auth::user()->id;
        $post->post_content=$request->post_content;
        $post->cat_id=$request->cat_id;
        $post->sub_cat_id=$request->sub_cat_id;
        $post->post_status=$request->post_status;
        $post->save();
        return redirect()->route('admin.post.show');
        
    }
    function post_show()
    {
        $list_posts=Post::orderBy('id','desc')->get();
        return view('admin/post/list-post',compact('list_posts'));

    }
    function post_detail($id)
    {
        $post= Post::find($id);
        return view('admin/post/detail-post',compact('post'));
    }
    function post_edit($id)
    {
        $post=Post::find($id);
        $list_cats=PostCat::all();
        $list_subcats=PostSubCat::where('cat_id',$post->cat_id)->get();
        return view('admin/post/edit-post',compact('post','list_cats','list_subcats'));
    }
    function post_edit_process(Request $request,$id)
    {
        $post=Post::find($id);
        $post->post_title=$request->post_title;
        $post->slug=Str::slug($request->post_title);
        $post->post_desc=Str::of($request->post_title)->limit(100);
        if($request->has('post_img'))
        {
            $file=$request->file('post_img');
            $post->post_img=$file->getClientOriginalName();
            $file->move('public/uploads/post',$file->getClientOriginalName());
            $img=Image::make("public/uploads/post/{$file->getClientOriginalName()}")->fit(200,200);
            $img->save();
        }
        else
        {
            $post->post_img=$post->post_img;
        }
        $post->user_id=Auth::user()->id;
        $post->post_content=$request->post_content;
        $post->cat_id=$request->cat_id;
        $post->sub_cat_id=$request->sub_cat_id;
        $post->post_status=$request->post_status;
        $post->save();
        return redirect()->route('admin.post.edit',$id);
    }
    function post_delete($id)
    {
        Post::find($id)->delete();
        return redirect()->route('admin.post.show');
    }
    function action(Request $request)
    {
        if($request->action==1)
        {
            foreach($request->choose as $key=>$value)
            {
                $choose[]=$key;
            }
            Post::destroy($choose);
            return redirect()->route('admin.post.show');
        }
       

    }
    function search(Request $request)
    {
        $search=$request->search;
        $list_posts=Post::where('post_title','LIKE',"%$search%")->orWhere('post_content','LIKE',"%$search%")->get();
        return view('admin/post/list-post',compact('list_posts'));
    }
    function post_by_cat($cat_id)
    {
        $list_posts=Post::where('cat_id',$cat_id)->get();
        return view('admin/post/list-post',compact('list_posts'));

    }
    function post_by_sub_cat($cat_id,$sub_cat_id)
    {
        $list_posts=Post::where([
            ['cat_id',$cat_id],
            ['sub_cat_id',$sub_cat_id]
            ])->get();
            return view('admin/post/list-post',compact('list_posts'));

    }
    function cat_delete($id)
    {
        $list_subcats=PostSubCat::where('cat_id',$id)->get();
        if($list_subcats->count()==0)
        {
            PostCat::find($id)->delete();
            return redirect()->route('admin.post.cat.add')->with('delete_success','Xóa thành công');
        }
        else
        {
            return redirect()->route('admin.post.cat.add')->with('delete_error','Không thể xóa được!!');

        }
    }
    function cat_edit($id)
    {
        $cat=PostCat::find($id);
        $list_cats_subcats=PostCat::all();
        foreach($list_cats_subcats as $item)
        {
            $item['subcat']=PostSubCat::where('cat_id',$item->id)->get();
        }
        return view('admin/post/edit-cat',compact('cat','list_cats_subcats'));
    }
    function cat_edit_process(Request $request,$id)
    {
        $cat=PostCat::find($id);
        $cat->title=$request->title;
        $cat->save();
        return redirect()->route('admin.post.cat.add')->with('edit_success','Đã sữa thành công');

    }
    function subcat_delete($id)
    {
        PostSubCat::find($id)->delete();
        return redirect()->route('admin.post.cat.add')->with('delete_success','Xóa thành công');
    }
    function subcat_edit($id)
    {
        $subcat=PostSubCat::find($id);
        $list_cats_subcats=PostCat::all();
        foreach($list_cats_subcats as $item)
        {
            $item['subcat']=PostSubCat::where('cat_id',$item->id)->get();
        }
        return view('admin/post/edit-subcat',compact('subcat','list_cats_subcats'));

    }
    function subcat_edit_process(Request $request,$id)
    {
        $subcat=PostSubCat::find($id);
        $subcat->title=$request->title;
        $subcat->save();
        return redirect()->route('admin.post.cat.add')->with('edit_success','Đã sữa thành công');
    }
}
