@extends('layouts/admin_layout')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            @if(session('delete_success'))
            <strong class="text-success">{{session('delete_success')}}</strong>
            @endif
            @if(session('add_success'))
            <strong class="text-success">{{session('add_success')}}</strong>
            @endif
            <div class="analytic">
                <a href="" class="text-primary">Trạng thái 1<span class="text-muted">(10)</span></a>
                <a href="" class="text-primary">Trạng thái 2<span class="text-muted">(5)</span></a>
                <a href="" class="text-primary">Trạng thái 3<span class="text-muted">(20)</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="">
                    <option>Chọn</option>
                    <option>Tác vụ 1</option>
                    <option>Tác vụ 2</option>
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count=1; @endphp
                    @foreach($list_products as $item)
                    <tr class="">
                        <td>
                            <input type="checkbox">
                        </td>
                        <td>{{$count}}</td>
                        <td><img style="width:100px" src="{{url('public/uploads/product/'.$item->product_img)}}" alt=""></td>
                        <td><a href="#">{{$item->product_name}}</a></td>
                        <td>{{number_format($item->price)}}đ</td>
                        <td>Điện thoại</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->qty}}</td>
                        <td>
                            @if($item->qty!=0)
                            <span class="badge badge-success">Còn hàng</span>

                            @else
                            <span class="badge badge-danger">Hết hàng</span>

                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.product.edit',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('admin.product.delete',$item->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có muốn xóa không?')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @php $count++; @endphp

                    @endforeach
                    
                    
                </tbody>
            </table>
            {{$list_products->links()}}

            <!-- <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">Trước</span>
                            <span class="sr-only">Sau</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav> -->
        </div>
    </div>
</div>
@endsection
