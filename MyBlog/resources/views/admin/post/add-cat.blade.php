@extends('layouts/admin_layout')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm danh mục
                </div>
                <div class="card-body">
                    <form action="{{route('admin.post.cat.add_process')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="title" id="name">
                        </div>
                        <div class="form-group">
                            <label for="">Danh mục cha</label>
                            <select class="form-control" id="" name="cat_id">
                                <option value="0">Không có</option>
                                @foreach($list_cats_subcats as $item)
                                <option value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Chờ duyệt
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
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
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh mục
                </div>
                <div class="card-body">
                    @if(session('add_success'))
                    <p class="text-success">{{session('add_success')}}</p>
                    @endif
                    @if(session('delete_error'))
                    <p class="text-danger">{{session('delete_error')}}</p>
                    @endif
                    @if(session('delete_success'))
                    <p class="text-success">{{session('delete_success')}}</p>
                    @endif
                    @if(session('edit_success'))
                    <p class="text-success">{{session('edit_success')}}</p>
                    @endif
                   @foreach($list_cats_subcats as $item)
                   <h5>
                       <a href="{{route('admin.post.post_by_cat',$item->id)}}">{{$item->title}}</a>
                       <a onclick="return confirm('Bạn có muốn xóa không?')" href="{{route('admin.post.cat.delete',$item->id)}}"><i class="far fa-window-close"></i></a>
                       <a href="{{route('admin.post.cat.edit',$item->id)}}"><i class="far fa-edit"></i></a>
                    </h5>
                   @foreach($item->subcat as $subcat)
                   <h6>
                       ---------------- <a href="{{route('admin.post.post_by_subcat',[$item->id,$subcat->id])}}">{{$subcat->title}}</a>
                       <a onclick="return confirm('Bạn có muốn xóa không?')" href="{{route('admin.post.subcat.delete',$subcat->id)}}"><i class="far fa-window-close"></i></a>
                       <a href="{{route('admin.post.subcat.edit',$subcat->id)}}"><i class="far fa-edit"></i></a>
                    </h6>
                   @endforeach

                   @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection