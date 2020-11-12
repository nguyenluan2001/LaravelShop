@extends('layouts/admin_layout')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
       
        <div class="card-body">
        <h2>{{$post->post_title}}</h2>
        <p>{!!$post->post_content!!}</p>
            
        </div>
    </div>
</div>
@endsection