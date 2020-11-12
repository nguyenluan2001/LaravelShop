<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function show()
    {
        $list_users=User::join('roles','users.role_id','roles.id')->get();
        return view('admin/user/list-user',compact('list_users'));
    }
    function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    function edit($id)
    {
        $user=User::find($id);
        $roles=Role::all();
        return view('admin/user/edit-user',compact('user','roles'));
    }
    function edit_process(Request $request)
    {
        // return $request->all();
        $user=User::find($request->id);
      
        $user->name=$request->name;
        $user->email=$request->email;
        $user->username=$request->username;
        $user->role_id=$request->role_id;
        $user->save();
        return redirect()->route('user.edit',$request->id);
    }
    function delete($id)
    {
        User::find($id)->delete();
        return redirect()->route('user.show');
    }
}
