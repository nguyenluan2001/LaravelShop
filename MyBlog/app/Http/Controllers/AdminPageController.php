<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    function show()
    {
        $list_pages=Page::all();
        return view('admin/page/list-page',compact('list_pages'));
    }
    function add_process(Request $request)
    {
        Page::create([
            'title'=>$request->title,
            'content'=>$request->content
        ]);
        return redirect()->route('admin.page.show');
    }
    function detail($id)
    {
        $page=Page::find($id);
        return view('admin/page/detail-page',compact('page'));
    }
    function edit($id)
    {
        $page=Page::find($id);
        return view('admin/page/edit-page',compact('page'));
    }
    function edit_process(Request $request,$id)
    {
        $page=Page::find($id);
        $page->title=$request->title;
        $page->content=$request->content;
        $page->save();
        return redirect()->route('admin.page.edit',$id);

    }
    function delete($id)
    {
        Page::find($id)->delete();
        return redirect()->route('admin.page.show');
    }
}
