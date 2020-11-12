@extends('layouts/admin_layout')
@section('content')
<div id="content" class="container-fluid">
                    <div class="card">
                        <div class="card-header font-weight-bold">
                            Thêm bài viết
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.post.add_process')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Tiêu đề bài viết</label>
                                    <input class="form-control" type="text" name="post_title" id="title">
                                </div>
                                <div class="form-group">
                                    <label for="content">Nội dung bài viết</label>
                                    <textarea name="post_content" class="form-control ckeditor" id="post_content" cols="30" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="post_img">Hình ảnh</label>
                                    <input class="form-control" type="file" name="post_img" id="post_img">
                                </div>

                                <div class="form-group" id="cat">
                                    <label for="">Danh mục cha</label>
                                    <select class="form-control" id="" name="cat_id">
                                      <option>Chọn danh mục</option>
                                      @foreach($list_cats as $item)
                                      <option value="{{$item->id}}">{{$item->title}}</option>

                                      @endforeach
                                      
                                    </select>
                                </div>
                                <div class="form-group" id="subcat">
                                    <label for="">Danh mục con</label>
                                    <p></p>
                                    <div></div>
                                    <select class='form-control' id='' name='sub_cat_id'>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Trạng thái</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="post_status" id="exampleRadios1" value="0" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                          Chờ duyệt
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="post_status" id="exampleRadios2" value="1">
                                        <label class="form-check-label" for="exampleRadios2">
                                          Công khai
                                        </label>
                                    </div>
                                </div>



                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </form>
                        </div>
                    </div>
                </div>
@endsection