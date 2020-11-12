@extends('layouts/admin_layout')
@section('content')
<div id="content" class="container-fluid">
                    <div class="card">
                        <div class="card-header font-weight-bold">
                            Thêm trang
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.page.add_process')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tiêu đề trang</label>
                                    <input class="form-control" type="text" name="title" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="content">Nội dung trang</label>
                                    <textarea name="content" class="form-control ckeditor" id="content" cols="30" rows="5"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </form>
                        </div>
                    </div>
                </div>

@endsection