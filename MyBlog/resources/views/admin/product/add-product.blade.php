@extends('layouts/admin_layout')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form action="{{route('admin.product.add_process')}}" method="post" enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input class="form-control" type="text" name="product_name" id="name">
                </div>
                <div class="form-group">
                    <label for="name">Mã sản phẩm</label>
                    <input class="form-control" type="text" name="product_code" id="name">
                </div>
                <div class="form-group">
                    <label for="name">Giá</label>
                    <input class="form-control" type="text" name="price" id="name">
                </div>
                <div class="form-group">
                    <label for="name">Số lượng</label>
                    <input class="form-control" type="text" name="qty" id="name">
                </div>

                <div class="form-group">
                    <label for="product_desc">Mô tả sản phẩm</label>
                    <textarea  class="form-control ckeditor" id="product_desc" name="product_desc" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="product_content">Chi tiết sản phẩm</label>
                    <textarea  class="form-control ckeditor" id="product_content" name="product_content" cols="30" rows="5"></textarea>
                </div>

                <div class="form-group">
                   <div class="custom-file">
                       <input type="file" class='custom-file-input' name="product_img">
                    <label for="product_img" class="custom-file-label">Hình ảnh</label>


                   </div>
                </div>
                <div class="form-group"  id="product_cat">
                    <label for="">Danh mục cha</label>
                    <select class="form-control" name="cat_id">
                        <option>Chọn danh mục</option>
                        @foreach($list_cats as $cat)
                        <option value="{{$cat->id}}">{{$cat->product_cat_title}}</option>
                        @endforeach
                       
                    </select>
                </div>
                <div class="form-group"  id="product_subcat">
                    <label for="">Danh mục con</label>
                    <select class="form-control" name="subcat_id">
                        <option>Chọn danh mục</option>
                        <option>Danh mục 1</option>
                        <option>Danh mục 2</option>
                        <option>Danh mục 3</option>
                        <option>Danh mục 4</option>
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
@endsection