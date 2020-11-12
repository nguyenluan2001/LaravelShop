@extends('layouts/admin_layout');
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Sửa thông tin người dùng
        </div>
        <div class="card-body">
            <form action="{{route('user.edit_process',$user->id)}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{$user->email}}">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" name="username" id="username" value="{{$user->username}}">
                </div>

                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select class="form-control" id="" name="role_id">
                        <option value="0">Chọn quyền</option>
                        @foreach($roles as $item)
                        <option value="{{$item->id}}" <?php if($user->role_id==$item->id) echo "selected='selected'" ?>>{{$item->name_role}}</option>

                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" name="btn_edit">Thay đổi</button>
            </form>
        </div>
    </div>
</div>

@endsection