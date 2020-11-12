@extends('layouts/admin_layout')
@section('content')
<div id="content" class="container-fluid">
                    <div class="card">
                        <div class="card-header font-weight-bold">
                            Thêm trang
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.page.edit_process',$page->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tiêu đề trang</label>
                                    <input class="form-control" type="text" name="title" id="name" value="{{$page->title}}">
                                </div>
                                <div class="form-group">
                                    <label for="content">Nội dung trang</label>
                                    <textarea name="content" class="form-control ckeditor" id="content" cols="30" rows="5">{{$page->content}}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Thay đổi</button>
                            </form>
                        </div>
                    </div>
                </div>

@endsection