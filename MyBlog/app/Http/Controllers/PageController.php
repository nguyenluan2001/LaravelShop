<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    function introduce($id)
    {
        $page= Page::find($id);
        return view('page',compact('page'));
    }
}
