<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    function list_posts()
    {
        $list_posts=Post::orderBy('id','desc')->paginate(5);
        return view('list-posts',compact('list_posts'));
    }
    function detail($id)
    {
        $post=Post::find($id);
        return view('detail-post',compact('post'));
    }
}
