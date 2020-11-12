@extends('layouts/admin_layout')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Sửa danh mục cha
                </div>
                <div class="card-body">
                    <form action="{{route('admin.product.cat.edit_process',$cat->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="title" id="name" value="{{$cat->product_cat_title}}">
                        </div>
                        
                       
                        <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
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
                    @if(session('status'))
                    <p class="text-danger">{{session('status')}}</p>
                    @endif
                   @foreach($list_cats_subcats as $cat)
                   <h5>
                       <a href="">{{$cat->product_cat_title}}</a>
                       <a onclick="return confirm('Bạn có muốn xóa không?')" href=""><i class="far fa-window-close"></i></a>
                       <a href=""><i class="far fa-edit"></i></a>
                    </h5>
                   @foreach($cat['subcats'] as $subcat)
                   <h6>
                       ---------------- <a href="">{{$subcat->product_sub_cat_title}}</a>
                       <a href=""><i class="far fa-window-close"></i></a>
                       <a href=""><i class="far fa-edit"></i></a>
                    </h6>
                   @endforeach

                   @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection