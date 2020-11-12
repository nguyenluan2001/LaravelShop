@extends('layouts/admin_layout')
@section('content')
<div id="content" class="container-fluid">
    
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách bài viết</h5>
            <div class="form-search form-inline">
                <form action="{{route('admin.post.search')}}" method="post" class="d-flex">
                    @csrf
                    <input type="text" name="search" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <form action="{{route('admin.post.action')}}" method="post">
        @csrf
        <div class="card-body">
            <div class="analytic">
                <a href="" class="text-primary">Trạng thái 1<span class="text-muted">(10)</span></a>
                <a href="" class="text-primary">Trạng thái 2<span class="text-muted">(5)</span></a>
                <a href="" class="text-primary">Trạng thái 3<span class="text-muted">(20)</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="" name="action">
                    <option>Chọn</option>
                    <option value="1">Xóa</option>
                    <option value="2">Ẩn</option>
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
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Số lượt xem</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count=1; @endphp
                    @foreach($list_posts as $item)
                    <tr>
                        <td>
                            <input type="checkbox" name="choose[{{$item->id}}]">
                        </td>
                        <td scope="row">{{$count}}</td>
                        <td><img src="{{url('public/uploads/post/'.$item->post_img)}}" alt="" style="width: 100px;"></td>
                        <td><a href="{{route('admin.post.detail',$item->id)}}">{{$item->post_title}}</a></td>
                        <td>Tin nóng</td>
                        <td>{{$item->views}}</td>
                        <td>
                            @if($item->post_status==0)
                            <p>Chờ duyệt</p>

                            @else
                            <p>Công khai</p>


                            @endif
                        </td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <a href="{{route('admin.post.edit',$item->id)}}" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a onclick="return confirm('Bạn có muốn xóa không?')" href="{{route('admin.post.delete',$item->id)}}" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>

                    </tr>
                    @php $count++; @endphp

                    @endforeach


                </tbody>
            </table>
            <nav aria-label="Page navigation example">
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
            </nav>
        </div>
        </form>
    </div>

    
   
</div>
@endsection